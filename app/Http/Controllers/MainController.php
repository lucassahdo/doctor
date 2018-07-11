<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;
use DateTime;

class MainController extends Controller 
{
    /**
     * 
     */
    public function dashboard() 
    {    
        $appointments = Schedule::orderBy('date','desc')->take(20)->get()->toArray();  
        foreach ($appointments as $i => $ap) {
            $doctor = Doctor::find($ap['doctor'])->toArray();
            $patient = Patient::find($ap['patient'])->toArray();
            $appointments[$i]['date'] = (new DateTime($appointments[$i]['date']))->format('d/m/Y');
            $appointments[$i]['doctor'] = $doctor;
            $appointments[$i]['patient'] = $patient;
        }  

        $schedules = Schedule::orderBy('date','asc')->get()->toArray();
        $data = [];
        $labels = [];
        $analytics = [];
        $appoint_count = Schedule::count();
        $appoint_pending = 0;
        $appoint_today = 0;

        foreach ($schedules as $sched) {
            $date   = (new DateTime($sched['date']))->format('d/m/Y');
            $_date  = explode('/', $date);
            $day    = $_date[0];
            $month  = $_date[1];
            $year   = $_date[2];
            $key    = $month . ' - ' . $year;

            $datetime = new DateTime($sched['date']);
            if ($datetime->getTimestamp() > time())
                $appoint_pending++;

            if ($date == date('d/m/Y'))
                $appoint_today++;
            
            if (isset($analytics[$key]))
                $analytics[$key]++;
            else
                $analytics[$key] = 1;
        }

        foreach ($analytics as $key => $value) {
            $labels[]   = $key;
            $data[]     = $value; 
        }

        return view('pages.dashboard', [
            'page' => 'analytics_dashboard',
            'page_title' => 'Dashboard',
            'appointments' => $appointments,
            'appoint_count' => $appoint_count,
            'appoint_pending' => $appoint_pending,
            'appoint_today' => $appoint_today,
            'labels' => $labels,
            'data' => $data
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
