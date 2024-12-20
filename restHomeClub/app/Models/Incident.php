<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $table = 'incidents';

    protected $fillable = [
        'apartament_id',
        'user_id',
        'description',
        'estate',
        'report'
    ];
}
