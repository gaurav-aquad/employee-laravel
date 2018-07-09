<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
