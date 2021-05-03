<?php

namespace App\Http\Controllers;

use App\Jobs\SendJobEmailSuratSuara;
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
        $calons = Participant::select(\DB::raw('participants.id,participants.name,participants.asal_dapen,participants.img_name,positions.name as jabatan'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',1)
                    ->get();

        $pengawas = Participant::select(\DB::raw('participants.id,participants.name,participants.asal_dapen,participants.img_name,positions.name as jabatan'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',2)
                    ->get();

        $posisi = Position::all();
        $statusVoting = ScheduleVoting::where('status',1)->get()->first();
        $jmlPemilih = Member::select(\DB::raw('ifnull(count(id),0) as jml'))->first();
        $jmlPilih = Member::select(\DB::raw('ifnull(count(id),0) as jml'))->where('vote_status',1)->first();
        $jmlBlumPilih = Member::select(\DB::raw('ifnull(count(id),0) as jml'))->where('vote_status',0)->first();
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
            $voting->ip_address = $request->getClientIp();
            $voting->position_id = $partisipan->position_id;
            $voting->save();
            //dd($member);
            $member = Member::find(auth()->user()->member_id);
            $member->vote_status = 1;
            $member->save();

            $posisi = Position::find($partisipan->position_id);
            $mailSubject ="Surat Suara ". $posisi->name;
            $data = [
                'user' => auth()->user()->email,
                'name' => auth()->user()->name,
                'pilahan' => $partisipan->name,
                'jenis' => $posisi->name,
            ];

            //Send Mail Invitation
            dispatch(new SendJobEmailSuratSuara(auth()->user()->email,$mailSubject,$data));
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
            $voting->ip_address = $request->getClientIp();
            $voting->save();

            $member = Member::find(auth()->user()->member_id);
            $member->vote_pengawas = 1;
            $member->save();

            $posisi = Position::find($partisipan->position_id);

            $mailSubject ="Surat Suara ". $posisi->name;
            
            $data = [
                'user' => auth()->user()->email,
                'name' => auth()->user()->name,
                'pilahan' => $partisipan->name,
                'jenis' => $posisi->name,
            ];

            //Send Mail Invitation
            dispatch(new SendJobEmailSuratSuara(auth()->user()->email,$mailSubject,$data));
            //Mail::to($member->email)->send(new VotingMail($data, $mailSubject));
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
        //if($request->ajax()){
            $calons = Participant::select(\DB::raw('participants.id,participants.position_id,participants.background_clr'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',1);

            /*$leftJoin = Voting::select(\DB::raw(' participant_id,position_id,count(id) as jml,ifnull((select count(id) as jml from members where vote_status <>0 ),0) as jmlsuara,ifnull((select count(id) as jml from members where status <>0 ),0) as jmlpemilih'))
                        ->groupBy('participant_id','position_id');

            
            $joinResults = Voting::select(\DB::raw('a.id,a.position_id,a.background_clr,ifnull(b.jml,0) as total,ifnull(b.jmlsuara,0) as jmlsuara,ifnull(b.jmlpemilih,0) as totalpemilih'))
                        ->from(\DB::raw('('.$calons->toSql().') as a '))
                        ->mergeBindings($calons->getQuery())
                        ->leftJoinSub($leftJoin,'b',function($join){
                            $join->on('a.id','=','b.participant_id');
                            $join->on('b.position_id','=','a.position_id');
                        });
                        //->get();
                    
            $results = Voting::select(\DB::raw('a.id,a.background_clr,a.position_id,a.total,a.jmlsuara,format((a.jmlsuara/a.totalpemilih)*100,2) as persentasesuara,format((a.total/a.jmlsuara)*100,2) as suara'))
                        ->from(\DB::raw('('.$joinResults->toSql().') as a '))
                        ->mergeBindings($joinResults->getQuery())
                        ->get();*/

            $joins = Voting::select(\DB::raw('participant_id,position_id,count(id) as jml,ifnull((select count(a.id) as jml from votings a where a.position_id=votings.position_id group by a.position_id),0) as jmlsuara '))
                        ->groupBy('position_id','participant_id');

            
            $joinResults = Voting::select(\DB::raw('a.participant_id,a.position_id,participants.background_clr,ifnull(a.jml,0) as total,ifnull(a.jmlsuara,0) as jmlsuara,format((a.jml/a.jmlsuara)*100,2) as persen'))
                        ->from(\DB::raw('('.$joins->toSql().') as a '))
                        ->mergeBindings($joins->getQuery())
                        ->join('participants','participants.id','=','a.participant_id')
                        ->where('a.position_id',1)
                        ->get();

            return response()->json($joinResults);
        //}
        
    }
    
    public function refreshPemilihPengawas(Request $request)
    {
        if($request->ajax()){
            $calons = Participant::select(\DB::raw('participants.id,participants.position_id,participants.background_clr'))
                    ->join('positions','positions.id','=','participants.position_id')
                    ->where('participants.position_id',2);

            $joins = Voting::select(\DB::raw('participant_id,position_id,count(id) as jml,ifnull((select count(a.id) as jml from votings a where a.position_id=votings.position_id group by a.position_id),0) as jmlsuara '))
                        ->groupBy('position_id','participant_id');

            
            $joinResults = Voting::select(\DB::raw('a.participant_id,a.position_id,participants.background_clr,ifnull(a.jml,0) as total,ifnull(a.jmlsuara,0) as jmlsuara,format((a.jml/a.jmlsuara)*100,2) as persen'))
                        ->from(\DB::raw('('.$joins->toSql().') as a '))
                        ->mergeBindings($joins->getQuery())
                        ->join('participants','participants.id','=','a.participant_id')
                        ->where('a.position_id',2)
                        ->get();
        
            /*$results = Voting::select(\DB::raw('a.id,a.background_clr,a.position_id,a.total,a.jmlsuara,format((a.total/a.jmlsuara)*100,2) as suara'))
                        ->from(\DB::raw('('.$joinResults->toSql().') as a '))
                        ->mergeBindings($joinResults->getQuery())
                        ->get();*/

            return response()->json($joinResults);
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
