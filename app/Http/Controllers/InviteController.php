<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreInvitePost;
use Illuminate\Support\Facades\Auth;
use App\Mail\InviteNotification;
use Illuminate\Support\Facades\Mail;
use App\Company;
use App\User;
use App\Invite;

class InviteController extends Controller
{
	public function inviteForm($id)
	{
		$company = Company::findOrFail($id);
		if ($company->user_id == Auth::user()->id) {
			return view('company.invite', compact('company'));
		} else {
			return redirect()->route('company.index');
		}
	}

	public function sendInvite(StoreInvitePost $request, $id)
	{
		$inviter = Auth::user()->id;
		$company = Company::findOrFail($id);
		$invitee = User::where('email', $request->email)->firstOrFail();

		if ($company->user_id == $inviter) { //check if user is the owner
			$invite = new Invite(['inviter_id' => $inviter,
				'invitee_id' => $invitee->id,
				'email' => $request->email]);
			$invite->inviteToken();
			$invite->save();
			Mail::to($request->email)->send(new InviteNotification($invite)); 
			return redirect()->route('company.index')->with('status', 'Invite has been sent.');
		} else {
			return redirect()->route('company.index');
		}
	}
}
