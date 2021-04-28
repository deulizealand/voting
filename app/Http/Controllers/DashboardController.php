<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Participant;
use App\Models\ScheduleVoting;
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
        return view('dashboard',compact('calons','statusVoting','jmlPemilih','jmlPilih','jmlBlumPilih'));
    }

    public function addVoting(Request $request, $id)
    {

    }
}
