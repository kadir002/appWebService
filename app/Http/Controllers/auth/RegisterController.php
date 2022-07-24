<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request){
      
        $validator = Validator::make($request->all(),[
            'email'=>'email|unique:users',
            'nickname'=>'unique:users,nickname'
        ]);
        if($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()]);
        }else{
            $check=$this->create($request->all());
            return response()->json(['success'=>true,'message'=>$check]);
        }


    }

    public function create(array $data){
      return User::create([
        'email'=>$data['email'],
        'nombre'=>$data['nombre'],
        'apellido'=>$data['apellido'],
        'nickname'=>$data['nickname'],
        'password' => Hash::make($data['password'])

      ]);
    }



}
