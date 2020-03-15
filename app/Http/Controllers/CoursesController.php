<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseUser;
use App\Jobs\CreateCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Exports\CoursesExport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class CoursesController extends Controller
{
    use JsonResponseTrait;

    public function create(Request $request){
      try {
        // Creating courses
      $courses = factory(Course::class, 50)->create();

      // Dispashing the job to the default queue. I hope this is what you guys meant in your task
      CreateCourses::dispatch();

      // Response
      return $this->successResponse('Creating courses', $courses);

      } catch (Exception $e){
        return $this->errorResponse('An error occurred', $e->getMessage());
      }
    }

    public function getAll(){
      try {
        $courses = Course::all();
        return $this->successResponse('Courses returned', $courses);
      } catch (Exception $e){
        return $this->errorResponse('An error occurred', $e->getMessage());
      }
      
    }

    public function registerUser(Request $request){
      $validator = Validator::make($request->all(), [
        'course_codes.*' => 'required|min:5|max:5|exists:courses,code'
      ]);
      if($validator->fails()){
        return $this->errorResponse('Validation error', $validator->getMessageBag()->all());
      }
      try {
        foreach($request->course_codes as $code):
          CourseUser::create([
            'email' => Auth::user()->email,
            'code' => $code
          ]);
      endforeach;
      return $this->successResponse('Registration complete');
      } catch (Exception $e){
        return $this->errorResponse('An error occurred', $e->getMessage());
      }
    }

    public function download() 
    {
        try {
          Excel::download(new CoursesExport, 'users.xlsx');
          return $this->successResponse('Download Successful');
        } catch (Exception $e){
          return $this->errorResponse('An error occurred', $e->getMessage());
        }
    }
}
