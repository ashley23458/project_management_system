<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = [
        'title', 'user_id', 'project_id', 'start_date', 'end_date', 'time_estimate'
    ];

	public function createdBy()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('user_id');
    }
}
