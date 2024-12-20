<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $table = 'incidents';

    protected $fillable = [
        'reserve_id',
        'user_id',
        'description',
        'estate',
        'report'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
