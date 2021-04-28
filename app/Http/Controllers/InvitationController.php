<?php

namespace App\Http\Controllers;

use App\Mail\AcceptInvitation;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function acceptInvitation($token)
    {
        if (!$invite = User::where('remember_token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }
    
        // create the user with the details from the invite
        $invite->email_verified_at = Carbon::now();
        $invite->remember_token = '';
        $invite->save();

        $member = Member::find($invite->member_id);
        $member->status = 2;
        $member->save();
        $mailSubject = 'Accept Invitation ';

        $details = [
            'url' => env('APP_NAME').'/login',
            'user' => $invite->email,
        ];

        Mail::to($invite->email)->send(new AcceptInvitation($details, $mailSubject));

        $param = [
            'user' => $invite->email,
        ];
        
        return view('accept')->with($param);

    }
}
