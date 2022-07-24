<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Models\commint;
use App\Models\like;
use App\Models\User;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class usuariosController extends Controller
{


    public function getData(){
        $data=usuario::with(['commints'])->get();
        return $data;
    }

   public function dataUser($id){
   return User::find($id);
   }

   

    public function storage(Request $request)
    {
        
       $user=  User::find($request['id']);


        $usuarios = new commint();
        $usuarios->user_id = $request['id'];
        $usuarios->likes = 0;
        $usuarios->commint = $request['commint'];
        $usuarios->nickname = $user->nickname;

       
        if( $usuarios->save()){
            $comentario=commint::find($usuarios->id);
             $comentario->like;
            return $comentario;
        }
           
     
      
    }

    public function like(Request $request){
      $like=new like();
      $like->commint_id=$request['commint_id'];
      $like->likes=$request['user_id'];

      $like->save();

      $comint=commint::find($request['commint_id']);

      $comint->likes=$comint->likes+1;

      $comint->update();



    }

    public function dislike($dislike,$comm_id){

        like::find($dislike)->delete();

        $comint=commint::find($comm_id);
        $comint->likes=$comint->likes-1;
        $comint->update();
    }


public function update(Request $request,$id){

    $user=User::find($id);

    if(!empty($request->fileSource)){
        $imageName = $this->randoImageName();
        $image = $request->fileSource;
        $imageContent = $this->imageBase64Content($image);
        Storage::put('public/productoImagen/'.$imageName, $imageContent);
        $user->img = 'http://192.168.1.143:8000/storage/productoImagen/' . $imageName;

       
    }

   if(!empty($request->nombre)){
     $user->nombre=$request->nombre;
   }
   if(!empty($request->apellido)){
    $user->apellido=$request->apellido;
  }
  if(!empty($request->nickname)){
    $user->nickname=$request->nickname;
  }


    $user->save();
}


public function randoImageName()
    {
        return Str::random(10) . '.' . 'jpg';
    }

    private function imageBase64Content($image)
    {
        $remplazar = array("data:image/png;base64,", "data:image/jpeg;base64,");
        $image = str_replace($remplazar, '', $image);
        $image = str_replace(' ', '+', $image);
        return base64_decode($image);
    }
}
