<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'jobtitle',
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
