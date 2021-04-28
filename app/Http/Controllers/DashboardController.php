<?php

namespace App\Http\Controllers;

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
        return view('dashboard',compact('calons','statusVoting'));
    }
}
