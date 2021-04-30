<?php

namespace App\Http\Controllers;

use App\Imports\DapenImport;
use App\Jobs\SendEmailJob;
use App\Jobs\SendEmailMassalJob;
use App\Jobs\SendInvitationEmailJob;
use App\Mail\AttachEmailPresentasi;
use App\Mail\Invitation;
use App\Mail\PengantarEmail;
use App\Models\Member;
use App\Models\ScheduleVoting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dapenUpload(Request $request)
    {
        if ($request->isMethod('get')){
            $member = new Member();
            $params = [
                'title' => 'Upload Daftar Dana Pensiun',
                'member' => $member,
            ];

            return view('members.import')->with($params);
        }else {
            $rules = [
                'lokasi_file' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json([
                    'fail' => true,
                    'errors' => $validator->errors()
                ]);
            
            Excel::import(new DapenImport(),request()->file('lokasi_file'));
            
            return response()->json([
                'fail' => false,
                'redirect_url' => url('members')
            ]);
        }
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $records = Member::all();

            return DataTables::of($records)
                ->addColumn('gabungan', function ($data) {
                    $uri_tamu = route('members.create',['sistem_id'=> 1]);
                    return '<div class="media-left">
                                <div class="media-body">
                                    <a href="#modalForm" data-href="'.$uri_tamu.'/'.$data->id.'/update" data-bs-toggle="modal" class="text-semibold">'.$data->name.'</a>
                                </div>
                                <div class="text-muted text-size-small"><span class="text-semibold">'.$data->email.'</span>
                                </div>
                            </div>';
                })
                ->addColumn('action', function ($data) {
                    $uri_tamu = route('members.create',['sistem_id'=> 1]);
                    if($data->status == 0){
                        return '<a href="#" onclick="kirimUndangan('.$data->id.');" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Mulai Voting">
                                <i class="align-middle" data-feather="trash">Kirim Undangan</i></a>';
                    }elseif($data->status==1){
                        return '<a href="#" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Mulai Voting">
                                <i class="align-middle" data-feather="trash">Undangan Terkirim</i></a>';
                    }else{
                        return '<a href="#" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Mulai Voting">
                                <i class="align-middle" data-feather="trash">Undangan Terverifikasi</i></a>';
                    }
                })
                ->rawColumns(['gabungan','action'])
                ->make(true);
        }
        return view('members.index');
    }

    public function addMember(Request $request, $sistem_id)
    {
        if ($request->isMethod('get')){
            $member  = new Member;
            $save_state = 'add';
            $title ="Pemilih Baru";
            return view('members.form',compact('member','save_state','title'));
            
        }else {
            $rules = [
                'name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
                ]);

            $peserta = new Member();
            $peserta->name = $request->name;
            $peserta->email = $request->email;
            $peserta->save();
        }
    }

    public function editMember(Request $request, $sistem_id, $id)
    {
        if ($request->isMethod('get')){
            $member  = Member::find($id);
            $save_state = 'edit';
            $title ="Edit Data Pemilih";
            return view('members.form',compact('member','save_state','title'));
            
        }else {
            $rules = [
                'name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
                ]);

            $peserta = Member::find($id);
            $peserta->name = $request->name;
            $peserta->email = $request->email;
            $peserta->save();
        
            return response()->json([
                'fail' => false,
                'redirect_url' => route('members')
            ]);
        }
    }

    public function sendInvitation($id)
    {
        $datas = Member::find($id);
        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random(8);
            //$tokenHash = Hash::make($token);
        } //check if the token already exists and if it does, try again
        while (User::where('remember_token', $token)->first());
        
        $strPassword = Str::random(8);

        $user = User::where('email',$datas->email)->first();
        if(!$user){
            $invite = new User();
            $invite->name = $datas->name;
            $invite->email = $datas->email;
            $invite->username = str_replace(' ','_',Str::substr(strtolower($datas->name),0,10));
            $invite->role_id = 3;
            $invite->member_id = $datas->id;
            $invite->password = $strPassword;
            $invite->remember_token = $token;
            $invite->save();
        }else{
            $token = $user->remember_token;
        }
        
        $acara = ScheduleVoting::where('status',0)->first();
        //dd($acara);
        if($acara !=null){
            $mailSubject = 'Undangan '. $acara->voting_name .' - '. $datas->name;
        }else{
            $acara = ScheduleVoting::where('status',1)->first();
            $mailSubject = 'Undangan '. $acara->voting_name .' - '. $datas->name;
        }
        //dd($acara);

        $uri_app = 'http://voting.dapenmapamsi.id';

        $hari = Carbon::parse($acara->voting_date);
        $namaHari = $hari->locale('id')->dayName;
        $endDay = Carbon::parse($acara->voting_end_date);
        $namaHariTerakhir = $endDay->locale('id')->dayName;

        $data = [
            'url_invitation' => $uri_app.'/'.'invitation/'.$token,
            'pass' => $strPassword,
            'user' => $datas->email,
            'acara' => $acara->voting_name,
            'hari' => $namaHari,
            'hariEnd' => $namaHariTerakhir,
            'tanggal'=> $acara->voting_date,
            'tanggalSelesai'=> $acara->voting_end_date,
            'jamMulai' => $acara->voting_time,
            'jamSelesai' => $acara->voting_end,
            'username' => str_replace(' ','_',Str::substr(strtolower($datas->name),0,10)), 
            'name' => $datas->name,
        ];

        //Send Mail Invitation
        dispatch(new SendInvitationEmailJob($datas->email,$mailSubject,$data));

        $datas->status = 1;
        $datas->save();
    }

    public function sendEmailMassal()
    {
        $members = Member::select(\DB::raw('id,name,email'))->get();

        $mailSubject = 'Verfikasi Alamat Email Sistem eVoting';
        
        foreach ($members as $value) {
            # code...
            //Mail::to($value->email)->send(new PengantarEmail($data, $mailSubject));
            dispatch(new SendEmailJob($value->email));
        }

        $notification = array(
            'message' => 'Pengiriman Email massal telah berhasil!',
            'alert-type' => 'success'
        ); 

        return redirect(route('dashboard'))->with($notification);
    }

    public function sendEmailBahanPresentasi()
    {
        $members = Member::select(\DB::raw('id,name,email'))->get();

        $mailSubject = 'File Presentasi';
        $file = storage_path('app/public/2021_Pra_MUnas-LB_ADPI.pptx');
        foreach ($members as $value) {
            # code...
            $data = [
                'user' => $value->email,
                'name' => auth()->user()->name,
            ];
            dispatch(new SendEmailMassalJob($value->email, $mailSubject, $file));
            //Send Mail Invitation
            //Mail::to($value->email)->send(new AttachEmailPresentasi($data, $mailSubject,$file));
        }
    }

    public function sendUndangan()
    {
        $members = Member::select(\DB::raw('id,name,email'))->where('status',0)->get();

        foreach ($members as $value) {
            # code...
            $datas = Member::find($value->id);
            do {
                //generate a random string using Laravel's str_random helper
                $token = Str::random(8);
                $tokenHash = Hash::make($token);
            } //check if the token already exists and if it does, try again
            while (User::where('remember_token', $token)->first());
            
            $strPassword = Str::random(8);

            $user = User::where('email',$datas->email)->first();
            if(!$user){
                $invite = new User();
                $invite->name = $datas->name;
                $invite->email = $datas->email;
                $invite->username = str_replace(' ','_',Str::substr(strtolower($datas->name),0,10));
                $invite->role_id = 3;
                $invite->member_id = $datas->id;
                $invite->password = $strPassword;
                $invite->remember_token = $token;
                $invite->save();
            }else{
                $token = $user->remember_token;
            }
            
            $acara = ScheduleVoting::where('status',0)->first();
            
            if($acara !=null){
                $mailSubject = 'Undangan '. $acara->voting_name .' - '. $datas->name;
            }else{
                $acara = ScheduleVoting::where('status',1)->first();
                $mailSubject = 'Undangan '. $acara->voting_name .' - '. $datas->name;
            }
            //dd($acara);

            $uri_app = 'http://voting.dapenmapamsi.id';

            $hari = Carbon::parse($acara->voting_date);
            $namaHari = $hari->locale('id')->dayName;
            $endDay = Carbon::parse($acara->voting_end_date);
            $namaHariTerakhir = $endDay->locale('id')->dayName;

            $data = [
                'url_invitation' => $uri_app.'/'.'invitation/'.$token,
                'pass' => $strPassword,
                'user' => $value->email,
                'acara' => $acara->voting_name,
                'hari' => $namaHari,
                'hariEnd' => $namaHariTerakhir,
                'tanggal'=> $acara->voting_date,
                'tanggalSelesai'=> $acara->voting_end_date,
                'jamMulai' => $acara->voting_time,
                'jamSelesai' => $acara->voting_end,
                'username' => str_replace(' ','_',Str::substr(strtolower($datas->name),0,10)), 
                'name' => $value->name,
            ];
            //dd($data);
            //Mail::to($value->email)->send(new PengantarEmail($data, $mailSubject));
            dispatch(new SendInvitationEmailJob($value->email,$mailSubject,$data));

            $datas->status = 1;
            $datas->save();
        }

        $notification = array(
            'message' => 'Pengiriman Undangan eVoting telah berhasil!',
            'alert-type' => 'success'
        ); 

        return redirect(route('members'))->with($notification);
    }
}
