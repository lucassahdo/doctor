<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'doctor', 
        'patient', 
        'date',
        'time',
        'name',
        'description'
    ];
}
