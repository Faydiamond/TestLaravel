<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserves extends Model
{
    use HasFactory;
    protected $table = 'reserves';

    protected $fillable = [
        'booking_date',
        'date_entry',
        'date_out',
        'price',
        'user_id',
        'apartament_id'
    ];
}
