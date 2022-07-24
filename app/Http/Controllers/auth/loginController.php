<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request){

   

       if(Auth::attempt($request->only('email','password'))){
        $user = User::where('email', $request['email'])->firstOrFail();
        return response()->json(['success' =>true,"info"=> $user]);
       }else{
        return response()->json(['success'=>false,'errors'=>'Unauthorized'],401);
       }
    }
}
