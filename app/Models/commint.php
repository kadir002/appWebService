<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commint extends Model
{
    use HasFactory;
    protected $fillable = [
        'commint',
        'likes',
        'usuario_id',
    ];
    public function usuario(){
         return $this->hasMany(usuario::class);
    }

    public function like(){
        return $this->hasMany(like::class);
    }
}
