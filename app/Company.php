<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = ['title', 'user_id'];

	public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
