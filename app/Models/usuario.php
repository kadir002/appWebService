<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nickname',
        'email',
        'nombre',
        'apellido',
        'password',
    ];

    public function commints(){
        return $this->hasMany(commint::class,'usuario_id');
    }
}
