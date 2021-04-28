<?php

namespace App\Http\Controllers;

use App\Models\ScheduleVoting;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ScheduleVotingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $records = ScheduleVoting::all();

            return DataTables::of($records)
                ->addColumn('gabungan', function ($data) {
                    $uri_tamu = route('schedule.create',['sistem_id'=> 1]);
                    return '<div class="media-left">
                                <div class="media-body">
                                    <a href="#modalForm" data-href="'.$uri_tamu.'/'.$data->id.'/update" data-bs-toggle="modal" class="text-semibold">'.$data->voting_name.'</a>
                                </div>
                            </div>';
                })
                ->addColumn('waktuvoting',function($data){
                    return '<div class="media-left">
                                <div class="media-body">
                                    <span class="text-semibold">'.Carbon::parse($data->voting_date)->format('d M Y').'</span>
                                </div>
                                <div class="text-muted text-size-small"><span class="text-semibold">'.Carbon::parse($data->voting_time)->format('h:i:s A').'</span>
                                </div>
                            </div>';
                })
                ->editColumn('status',function($data){
                    if($data->status==0){
                        return '<span class="badge bg-success">Aktif</span>';
                    }elseif($data->status==1){
                        return '<span class="badge bg-warning">Mulai</span>';
                    }else{
                        return '<span class="badge bg-danger">Berhenti</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $uri_tamu = route('schedule.mulai',['id'=> $data->id]);
                    //$uri_add = route('kepesertaan.komda.mitra.create',['komda_id'=> $data->komda_id]);
                    if($data->status == 0){
                        return '<a href="#" onclick="postActive('.$data->id.');" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Mulai Voting">
                                <i class="align-middle" data-feather="trash">Mulai</i></a>';
                    }elseif($data->status == 1){
                        return '<a href="#" onclick="postStop('.$data->id.');" data-id='.$data->id.' data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Berhenti Voting">
                                <i class="align-middle" data-feather="trash">Berhenti</i></a>';
                    }else{
                        return '<a href="#" data-token="{{csrf_token()}}" data-bs-toggle="tooltip" title="Selesai Voting">
                                <i class="align-middle" data-feather="trash">Selesai</i></a>';
                    }

                })
                ->rawColumns(['gabungan','waktuvoting','status','action'])
                ->make(true);
        }
        return view('schedules.index');
    }

    public function addSchedule(Request $request, $sistem_id)
    {
        if ($request->isMethod('get')){
            $schedule  = new ScheduleVoting;
            $save_state = 'add';
            $title ="Jadwal Baru";
            return view('schedules.form',compact('schedule','save_state','title'));
            
        }else {
            $rules = [
                'voting_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
                ]);

            $peserta = new ScheduleVoting();
            $peserta->voting_name = $request->voting_name;
            $peserta->voting_date = $request->voting_date;
            $peserta->voting_time = $request->voting_time;
            $peserta->user_id = auth()->user()->id;
            $peserta->save();
            
            return response()->json([
                'fail' => false,
                'redirect_url' => route('schedule')
            ]);
        }
    }

    public function editSchedule(Request $request, $sistem_id, $id)
    {
        if ($request->isMethod('get')){
            $schedule  = ScheduleVoting::find($id);
            $save_state = 'edit';
            $title ="Edit Jadwal Voting";
            return view('schedules.form',compact('schedule','save_state','title'));
            
        }else {
            $rules = [
                'voting_name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
                ]);
                
            $peserta = ScheduleVoting::find($id);
            $peserta->voting_name = $request->voting_name;
            $peserta->voting_date = $request->voting_date;
            $peserta->voting_time = $request->voting_time;
            $peserta->user_id = auth()->user()->id;
            $peserta->save();
        
            return response()->json([
                'fail' => false,
                'redirect_url' => route('schedule')
            ]);
        }
    }

    public function mulaiVoting(Request $request, $id)
    {
        $peserta = ScheduleVoting::find($id);
        $peserta->status = 1;
        $peserta->save();
    
        return response()->json([
            'fail' => false,
            'redirect_url' => route('schedule')
        ]);
    }

    public function berhentiVoting(Request $request, $id)
    {
        $peserta = ScheduleVoting::find($id);
        $peserta->status = 2;
        $peserta->save();
    
        return response()->json([
            'fail' => false,
            'redirect_url' => route('schedule')
        ]);
    }
}
