<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Invite extends Model
{
	protected $fillable = [
        'email', 'invite_token', 'inviter_id', 'invitee_id', 'company_id', 'status'
    ];

	public function inviteToken()
	{

		$this->invite_token = preg_replace('/[^a-zA-Z0-9]/', '', Hash::make($this->id . now()->timestamp));
	}

	public function inviter()
	{
		return $this->belongsTo('App\User', 'inviter_id', 'id');
	}

	public function invitee()
	{
		return $this->belongsTo('App\User', 'invitee_id', 'id');
	}

	public function company()
	{
		return $this->belongsTo('App\Company', 'company_id', 'id');
	}
}
