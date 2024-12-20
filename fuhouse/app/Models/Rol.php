<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    use HasFactory;
    protected $table = 'rols';

    protected $fillable = [
        'rol'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Relación: cada Post pertenece a un User
    }
}
