<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
class ApiRegisterController extends Controller
{
    public function register(Request $request)
    {
              
      $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
           
        ]);
      if($validator->fails())
      {
      	return response->json($validator->error());
      }
      $user=User::create([
          'email'=>$request->email,
          'name'=>$request->name,
          'password'=bcrypt($request->password),

      ]);
      $token=JWTAuth::fromUser($user);
      return response()->json(compact('token'));

    }
}
