<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public function createdBy()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    //
}
