<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $fillables = ['code', 'name', 'status'];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public $appends = ['user_registered_at'];

    public function setStatusAttribute($status)
    {
        switch($status){
            CASE 0: 
            return 'disabled';
            break;
        default:
            return 'active';
        }
    }

    public function getUserRegisteredAtAttribute(){
        if(Auth::user()):
            $authenticatedUserCourses = Auth::user()->courses;
            foreach($authenticatedUserCourses as $course):
                if($course->code === $this->code):
                return $course->created_at;
                endif;
            endforeach;
        endif;
        return null;
    }

    public function users(){
        return $this->hasMany('App\CourseUser','code','code');
    }



}
