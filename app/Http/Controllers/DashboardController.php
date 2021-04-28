<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Participant;
use App\Models\ScheduleVoting;
use App\Models\Voting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $calons = Participant::with('posisi')->get();
        $statusVoting = ScheduleVoting::where('status',1)->get()->first();
        $jmlPemilih = Member::select(\DB::raw('count(id) as jml'))->first();
        $jmlPilih = Member::select(\DB::raw('count(id) as jml'))->where('vote_status',1)->first();
        $jmlBlumPilih = Member::select(\DB::raw('count(id) as jml'))->where('vote_status',0)->first();
        $member = Member::find(auth()->user()->member_id);
        return view('dashboard',compact('calons','member','statusVoting','jmlPemilih','jmlPilih','jmlBlumPilih'));
    }

    public function addVoting(Request $request, $id)
    {
        if($request->ajax())
        {
            $voting = new Voting();
            $voting->participant_id = $id;
            $voting->member_id = auth()->user()->member_id;
            $voting->ip_address = $this->getIp();
            $voting->save();

            $member = Member::find(auth()->user()->member_id);
            $member->vote_status = 1;
            $member->save();
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
