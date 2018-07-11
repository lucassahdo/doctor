<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendant extends Model
{
    protected $fillable = [
        'name',
        'lastname',
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
