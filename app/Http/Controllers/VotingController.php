<?php

namespace App\Http\Controllers;

use App\Models\ScheduleVoting;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            
        }
        $cekVoting = "";
        return view('votings.index',compact('cekVoting'));
    }
}
