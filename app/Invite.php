<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Invite extends Model
{
	protected $fillable = [
        'email', 'invite_token', 'inviter_id', 'invitee_id'
    ];

	public function inviteToken()
	{
		$this->invite_token = Hash::make(rand(0, 9) . $this->email . now()->timestamp);
	}

	public function inviter()
	{
		return $this->belongsTo('App\User', 'inviter_id', 'id');
	}

	public function invitee()
	{
		return $this->belongsTo('App\User', 'invitee_id', 'id');
	}
}
