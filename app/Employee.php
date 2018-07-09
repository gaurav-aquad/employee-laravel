<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['name', 'email', 'role', 'salary'];

    public function skill()
    {
        return $this->hasMany('App\Skill', 'emp_id');
    }
}
