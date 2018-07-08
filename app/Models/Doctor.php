<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'function',
        'cep',
        'street',        
        'district',
        'state',
        'city',                 
        'cellphone',       
        'phone',
        'email'
    ];    
}
