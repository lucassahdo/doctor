<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;

class MainController extends Controller 
{

    /**
     * 
     */
    public function dashboard() 
    {    
        $appointments = Schedule::orderBy('created_at','desc')->take(20)->get()->toArray();  

        foreach ($appointments as $i => $ap) {
            $doctor = Doctor::find($ap['doctor'])->toArray();
            $patient = Patient::find($ap['patient'])->toArray();
            $appointments[$i]['doctor'] = $doctor;
            $appointments[$i]['patient'] = $patient;
        }  

        $appoint_count = Schedule::count();
        $appoint_pending = 23; // implement later
        $appoint_today = 8; // implement later
        return view('pages.dashboard', [
            'page' => 'analytics_dashboard',
            'page_title' => 'Dashboard',
            'appointments' => $appointments,
            'appoint_count' => $appoint_count,
            'appoint_pending' => $appoint_pending,
            'appoint_today' => $appoint_today
        ]);
    } 

    /**
     * 
     */
    public function notfound() 
    {        
        return view('pages.errors.404');
    }    

    /**
     * 
     */
    public function about() 
    {        
        return view('pages.about', [
            'page' => 'about',
            'page_title' => 'Sobre'
        ]);
    }      
}
