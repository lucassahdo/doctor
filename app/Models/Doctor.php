<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'user',
        'function',
        'cep',
        'street',       
        'number', 
        'district',
        'state',
        'city',                 
        'cellphone',       
        'phone',
        'email'
    ];    
}
