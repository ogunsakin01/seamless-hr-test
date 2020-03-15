<?php 
namespace App\Http\Controllers;

Trait JsonResponseTrait{
    protected function successResponse($message, $data = []){
       return response()->json([
           'status' => 'success',
           'message' => $message,
           'data' => $data
       ],200);
    }

    protected function errorResponse($message, $errors = []){
        return response()->json([
            'status' => 'failed',
            'message' => $message,
            'errors' => $errors
        ],400);
    }

    protected function unAuthenticatedResponse($message, $errors = []){
        return response()->json([
            'status' => 'Unauthenticated',
            'message' => $message,
            'errors' => $errors
        ],401);
    }

}