<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Models\commint;
use App\Models\User;
use Illuminate\Http\Request;

class ViewUserController extends Controller
{
    public function showUser($id)
    {  
        $coment=User::with(['commints.like'=>function($query){
            $query->orderBy('created_at','asc');
        }])->where('id',$id)->get();
        
        return response()->json($coment);
    }


    public function search(Request $request)
    {


        $search = $request['search'];
   if(!empty($search)){

 
        $data = User::where('email', 'LIKE', '%' . $search . '%')
            ->orWhere('nombre', 'LIKE', '%' . $search . '%')
            ->orWhere('apellido', 'LIKE', '%' . $search . '%')
            ->orWhere('nickname','LIKE', '%' . $search . '%')
            ->get();


        if(count($data)>0) {

            $array = [];

            foreach ($data as $row) {
                $array[] = [
                    "nickname" => $row['nickname'],
                    "img" => $row['img'],
                    "id"=>$row['id'],
    
                ];
            }
            return response()->json(["ok"=>true,$array]);

        }
    }
        return response()->json(["ok"=>false]);
    }
}
