<?php

namespace App\Http\Controllers\commint;

use App\Http\Controllers\Controller;
use App\Models\commint;
use App\Models\like;
use Illuminate\Http\Request;

class CommintController extends Controller
{
    public function index($id){

         
        return commint::with(['like'=>function($query) use($id){
            $query->where('likes',$id);
           }])->orderBy('created_at','desc')->get();
    }

   

   
}
