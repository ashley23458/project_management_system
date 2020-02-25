<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = [
        'title', 'description', 'user_id', 'project_id', 'start_date', 'end_date', 'time_estimate', 'status'
    ];

    protected $dates = ['start_date', 'end_date'];

	public function createdBy()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('user_id');
    }

    public static function getPercentageCompleted($total, $number)
    {
        if ($total > 0) {
            return round($number / ($total / 100), 2);
        } else {
            return 0;
        }
    }
}
