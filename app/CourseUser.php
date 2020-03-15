<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $fillable = ['code', 'email'];

    protected $table = 'course_user';

    public function users(){
        return $this->belongsToMany('App\User', 'email', 'email');
    }

    public function courses(){
        return $this->belongsToMany('App\Course', 'code', 'code');
    }
}

