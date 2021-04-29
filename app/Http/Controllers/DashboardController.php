<?php

namespace App\Http\Controllers;

use App\Mail\VotingMail;
use App\Models\Member;
use App\Models\Participant;
use App\Models\Position;
use App\Models\ScheduleVoting;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $calons = Participant::select(\DB::raw('participants.id,participants.name,participants.asal_dapen,participants.img_name,positions.name as jabatan,
                    ifnull((select count(id) as jml from votings where votings.participant_id=participants.id group by id),0) as total'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',1)
                    ->get();

        $pengawas = Participant::select(\DB::raw('participants.id,participants.name,participants.asal_dapen,participants.img_name,positions.name as jabatan,
                    ifnull((select count(id) as jml from votings where votings.participant_id=participants.id group by id),0) as total'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',2)
                    ->get();
        $posisi = Position::all();
        $statusVoting = ScheduleVoting::where('status',1)->get()->first();
        $jmlPemilih = Member::select(\DB::raw('count(id) as jml'))->first();
        $jmlPilih = Member::select(\DB::raw('count(id) as jml'))->where('vote_status',1)->first();
        $jmlBlumPilih = Member::select(\DB::raw('count(id) as jml'))->where('vote_status',0)->first();
        $member = Member::find(auth()->user()->member_id);
        //dd($calons);
        return view('dashboard',compact('calons','posisi','pengawas','member','statusVoting','jmlPemilih','jmlPilih','jmlBlumPilih'));
    }

    public function viewDataPemilih(Request $request, $id)
    {
        /*if($request->ajax()){
            $members  = Member::select(\DB::raw('id,name,vote_status'))
                    ->where('vote_status',$id)
                    ->get();

            return DataTables::of($members)
                    ->addColumn('gabungan', function ($data) {
                        return '<div class="media-left">
                                    <div class="media-body">
                                        <span class="text-semibold">'.$data->name.'</span>
                                    </div>
                                </div>';
                    })
                    ->editColumn('status',function($data){
                        if($data->vote_status==1){
                            return '<span class="badge bg-success">Sudah Memilih</span>';
                        }else{
                            return '<span class="badge bg-warning">Belum Memilih</span>';
                        }
                    })
                    ->rawColumns(['gabungan','status'])
                    ->make(true);
        }*/
        $members  = Member::select(\DB::raw('id,name'))
                    ->where('vote_status',$id)
                    ->get();
        $id = $id;
        $pilih = Member::find($id);
        $save_state = 'view';
        $title ="View Data Pemilih";
        return view('vote',compact('pilih','members','id','save_state','title'));
    }

    public function addVoting(Request $request, $id)
    {
        if($request->ajax())
        {
            
            $partisipan = Participant::find($id);

            $voting = new Voting();
            $voting->participant_id = $id;
            $voting->member_id = auth()->user()->member_id;
            $voting->ip_address = $this->getIp();
            $voting->position_id = $partisipan->position_id;
            $voting->save();
            //dd($member);
            $member = Member::find(auth()->user()->member_id);
            $member->vote_status = 1;
            $member->save();

            $mailSubject ="Terima Kasih Telah Menggunakan Suara Anda";
            
            $data = [
                'user' => auth()->user()->email,
                'name' => auth()->user()->name,
            ];

            //Send Mail Invitation
            Mail::to($member->email)->send(new VotingMail($data, $mailSubject));
        }
    }

    public function addVotingPengawas(Request $request, $id)
    {
        if($request->ajax())
        {
            $partisipan = Participant::find($id);

            $voting = new Voting();
            $voting->participant_id = $id;
            $voting->member_id = auth()->user()->member_id;
            $voting->position_id = $partisipan->position_id;
            $voting->ip_address = $this->getIp();
            $voting->save();

            $member = Member::find(auth()->user()->member_id);
            $member->vote_pengawas = 1;
            $member->save();

            $mailSubject ="Terima Kasih Telah Menggunakan Suara Anda";
            
            $data = [
                'user' => auth()->user()->email,
                'name' => auth()->user()->name,
            ];

            //Send Mail Invitation
            Mail::to($member->email)->send(new VotingMail($data, $mailSubject));
        }
    }

    private function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    } 

    public function refreshPemilih(Request $request)
    {
        if($request->ajax())
        {
            $calons = Participant::select(\DB::raw('participants.id,participants.position_id,
                    ifnull((select count(id) as jml from votings where votings.participant_id=participants.id and participants.position_id=votings.position_id group by id),0) as total'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',1)
                    ->get();

            return response()->json($calons);
        }
        
    }
    
    public function refreshPemilihPengawas(Request $request)
    {
        if($request->ajax())
        {
            $calons = Participant::select(\DB::raw('participants.id,participants.position_id,
                    ifnull((select count(id) as jml from votings where votings.participant_id=participants.id and participants.position_id=votings.position_id group by id),0) as total'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',2)
                    ->get();

            return response()->json($calons);
        }
        
    }

    public function getJamSaatIni(Request $request)
    {
        if($request->ajax())
        {
            return date('H:i:s');
        }
    }

    public function getJamVoting(Request $request)
    {
        if($request->ajax())
        {
            $jamMulai = ScheduleVoting::where('status',1)->first();

            return response()->json($jamMulai);
        }
    }
}
