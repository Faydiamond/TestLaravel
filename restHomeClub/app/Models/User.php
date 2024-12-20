<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'telphone',
        'role_id',
        'city_id',
    ];
    public function role()
    {
        return $this->belongsTo(Rol::class);
    }
}
