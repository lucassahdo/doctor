<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'purpose',
        'details',
        'doctor', 
        'patient', 
        'created_by', 
        'date',
        'time'
    ];
}
