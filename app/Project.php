<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = [
        'title', 'description', 'status', 'company_id', 'percentage'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
