<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartament extends Model
{
    use HasFactory;
    protected $table = 'apartaments';

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'telphone',
        'city_id'
    ];

    public function city()
    {
        return $this->hasMany(City::class); // Relación: un User tiene muchos Posts
    }
    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
}
