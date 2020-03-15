<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use JsonResponseTrait;

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        if($validator->fails()) return $this->errorResponse('Validation Error', $validator->getMessageBag()->all());
        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if($createUser) return $this->successResponse('User created', $createUser);
        return $this->errorResponse('Unable to create user');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()) return $this->errorResponse('Validation Error', $validator->getMessageBag()->all());
        $user = User::where('email', $request->email)->first();
        $checkPassword = Hash::check($request->password, $user->password);
        if(!($checkPassword)) return $this->errorResponse('Invalid credentials',$checkPassword);
        $user->api_token = hash('sha256', Str::random(20));
        $user->update();
        return $this->successResponse('User login successful', $user);
    }

    public function logout(Request $request){
        $user = User::where('email', Auth::user()->email)->first();
        $user->api_token = null;
        $user->update();
        return $this->successResponse('User logout successful');
    }
}
