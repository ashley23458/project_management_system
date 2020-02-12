<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = [
        'title', 'description', 'status', 'company_id'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
