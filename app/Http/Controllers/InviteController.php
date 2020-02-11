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
				'company_id' => $id,
				'email' => $request->email]);
			$invite->inviteToken();
			$invite->save();
			Mail::to($request->email)->send(new InviteNotification($invite)); 
			return redirect()->route('company.index')->with('status', 'Invite has been sent.');
		} else {
			return redirect()->route('company.index');
		}
	}

	public function viewInvite($token)
	{
		$invite = Invite::where('invite_token', $token)
		->where('invitee_id', Auth::user()->id)
		->firstOrFail();

		$token = rawurlencode($token);

		return view('company.view_invite', compact('invite', 'token'));
	}

	public function inviteResponse($response, $token)
	{
		$invite = Invite::where('invite_token', $token)
			->where('invitee_id', Auth::user()->id)
			->firstOrFail();

		$userExists = User::whereHas('companies', function($query) use ($invite) {
			$query->where('company_id', $invite->company_id)->where('company_user.user_id', $invite->invitee_id);
		})->first();

		if ($response) { //if user wants to accept invitation
            if (!$userExists) { //and if user doesn't already exist in the company
            	$invite->update(['status' => 1]);
            	Auth::user()->companies()->attach($invite->company_id); //add them to the company
            	$message = "You have successfully joined the company" .$invite->company->name. "!";
            } else {
            	$message = "You have already joined this company!";
            }			
		} else {
			if ($invite->status == null) { //if user hasn't already responded
				$invite->update(['status' => 1]);
				$message = "You have declined the invitation!";
			} else {
				$message = "You have already responded to this invitation!";
			}
		} 

		return redirect()->route('company.index')->with('status', $message);
	}
}
