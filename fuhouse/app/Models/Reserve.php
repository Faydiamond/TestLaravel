<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apartament()
    {
        return $this->belongsTo(Apartament::class);
    }
}
