<?php

use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\commint\CommintController;
use App\Http\Controllers\usuarios\usuariosController;
use App\Http\Controllers\usuarios\ViewUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::Post('validateUser',[usuariosController::class,'validateUser']);

Route::Post('/storage',[usuariosController::class,'storage']);

Route::get('comentarios',[usuariosController::class,'getData']);

Route::get('/commint/{id}',[CommintController::class,'index']);

Route::post('/register',[RegisterController::class,'register']);

Route::post('/login',[loginController::class,'login']);

Route::get('/data-user/{id}',[usuariosController::class,'dataUser']);

Route::get('/view-user/{id}',[ViewUserController::class,'showUser']);



Route::get('/search',[ViewUserController::class,'search']);

Route::post('/like',[usuariosController::class,'like']);

Route::get('/dislike/{dislike}/{comm_id}',[usuariosController::class,'dislike']);


Route::put('/update/{id}',[usuariosController::class,'update']);