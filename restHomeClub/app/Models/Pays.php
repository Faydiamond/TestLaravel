<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $table = 'payss';

    protected $fillable = [
        'task_id',
        'reservation_id',
        'price',
        'booking_date',
        'cost_responsible'
    ];
}
