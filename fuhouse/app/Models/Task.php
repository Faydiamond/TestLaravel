<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'incidencia_id',
        'description',
        'estate',
        'price',
        'cost_responsible'
    ];

    public function incidencia()
    {
        return $this->belongsTo(Incident::class);
    }
}
