<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'citys';

    protected $fillable = [
        'city'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function apartament()
    {
        return $this->belongsTo(Apartament::class);
    }
    public function reserve()
    {
        return $this->belongsTo(Reserve::class);
    }
}
