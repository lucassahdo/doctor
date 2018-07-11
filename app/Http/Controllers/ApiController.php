<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;
use DateTime;

class ApiController extends Controller 
{
    /**
     * 
     */
    public function doctors() 
    {   
        $response = [];
        $response['result'] = Doctor::all()->toArray();
        $response['status'] = 'ok';
        return response()->json($response);
    } 

    /**
     * 
     */
    public function patients() 
    {        
        $response = [];
        $response['result'] = Patient::all()->toArray();
        $response['status'] = 'ok';
        return response()->json($response);
    }    

    /**
     * 
     */
    public function schedules() 
    {
        $response = [];
        $response['result'] = Schedule::all()->toArray();
        $response['status'] = 'ok';
        return response()->json($response);
    }
}
