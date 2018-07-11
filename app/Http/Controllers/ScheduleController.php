<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Auth;
use DateTime;
use DB;

class ScheduleController extends Controller
{
    private $items_limit = 30;

    /**
     * 
     */
    public function new()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('pages.schedule.new', [
            'page' => 'schedule-new',
            'page_title' => 'Nova Consulta',
            'doctors' => $doctors,
            'patients' => $patients
        ]);
    }

    /**
     * 
     */
    public function manage() 
    {
        $schedules = Schedule::paginate($this->items_limit);   
        $items = [];
        foreach ($schedules->toArray()['data'] as $i => $it) {
            $items[$i] = $it;
            $doctor = Doctor::find($it['doctor'])->toArray();
            $patient = Patient::find($it['patient'])->toArray();
            $items[$i]['doctor'] = $doctor;
            $items[$i]['patient'] = $patient;
        }

        return view('pages.schedule.manage', [
            'page' => 'schedule-manage',
            'page_title' => 'Gerenciar Consultas',
            'items' => $items,
            'links' => $schedules->links()
        ]);
    }    

    /**
     * 
     */
    public function table(Request $req)
    {
        $start = (int) $req->start;
        $length = ($req->length !== -1) ? (int) $req->length : 50;   
        $search = (isset($req->search['value']) && strlen($req->search['value']) > 0) ? $req->search['value'] : false;

        $response = [];
        $response['draw'] = 0;
        $response['data'] = [];
        if ($search) {
            $result = Schedule::orderBy('date','desc')
                    ->join('doctors', 'schedules.doctor', '=', 'doctors.id')
                    ->join('patients', 'schedules.patient', '=', 'patients.id')
                    ->select('schedules.*', 'doctors.name', 'doctors.lastname', 'patients.name', 'patients.lastname')                   
                    ->where('purpose', 'like', '%' . $search . '%')
                    ->orWhere('details', 'like', '%' . $search . '%')
                    ->orWhere('doctors.name', 'like', '%' . $search . '%')
                    ->orWhere('doctors.lastname', 'like', '%' . $search . '%')
                    ->orWhere('patients.name', 'like', '%' . $search . '%')
                    ->orWhere('patients.lastname', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%')
                    ->orWhere('time', 'like', '%' . $search . '%')
                    ->skip($start)
                    ->take($length)                    
                    ->get();            
            $response['recordsTotal'] = count($result);
            $response['recordsFiltered'] = count($result);            
        }
        else {
            $result = Schedule::orderBy('date','desc')
                    ->skip($start)
                    ->take($length)
                    ->get();
            $response['recordsTotal'] = Schedule::count();
            $response['recordsFiltered'] = Schedule::count();    
        }

        $i = 0;
        foreach ($result as $res) {
            $actions = '
                <td class="actions text-right">
                    <a href="' . '/schedule/edit/' . $res['id'] . '" class="btn btn-round btn-warning btn-icon btn-sm edit">
                        <i class="fas fa-edit"></i>                                        
                    </a>
                    <a href="' . '/schedule/delete/' . $res['id'] . '" class="btn btn-round btn-danger btn-icon btn-sm remove">
                        <i class="fas fa-minus"></i>                                        
                    </a>
                </td>
            ';

            $doctor = Doctor::find($res['doctor'])->toArray();
            $patient = Patient::find($res['patient'])->toArray();

            $data = [       
                ++$i,        
                $res['purpose'], 
                $res['details'], 
                'Dr(a). ' . $doctor['name'] . ' ' . $doctor['lastname'],
                $patient['name'] . ' ' . $patient['lastname'],
                (new DateTime($res['date']))->format('d/m/Y'),
                $res['time'],
                $actions
            ];
            $response['data'][] = $data;
        }   
        return response()->json($response);
    }

    /**
     * 
     */
    public function edit($id) {
        $schedule = Schedule::find($id); 
        $doctors = Doctor::all();
        $patients = Patient::all();   
        return view('pages.schedule.new', [
            'page' => 'schedule-edit',
            'page_title' => 'Editar Consulta',
            'schedule' => $schedule,
            'doctors' => $doctors,
            'patients' => $patients
        ]);
    } 

    /**
     * 
     */
    public function create(Request $req) 
    {          
        $data = $req->all();
        $result = [];              
        
        if (isset($data['date'])) {
            $date = explode('/', $data['date']);
            $day = $date[0];
            $month = $date[1];
            $year = $date[2];
            $date = $year . '-' . $month . '-' . $day;
            $data['date'] = $date; 
        }

        if (Auth::check()) 
            $data['created_by'] = Auth::id();
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro: usuário não está logado';
            return response()->json($result);
        }

        if (Schedule::create($data)) {
            $result['status'] = 'ok';
            $result['message'] = 'sucesso ao criar consulta';
            $result['redirect'] = '/schedule/manage';
            $result['data'] = $data;
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao tentar criar consulta';
        }
        return response()->json($result);  
    } 

        /**
     * 
     */
    public function update(Request $req, $id) 
    {                   
        $schedule = Schedule::find($id);    
        $schedule->purpose    = $req->purpose; 
        $schedule->details    = $req->details;
        $schedule->doctor     = $req->doctor;
        $schedule->patient    = $req->patient;        
        $date                 = $req->date;   
        $date                 = explode('/', $date);
        $day                  = $date[0];
        $month                = $date[1];
        $year                 = $date[2];
        $date                 = $year . '-' . $month . '-' . $day;
        $schedule->date       = $date;         
        $schedule->time       = $req->time;

        $result = [];         
        if ($schedule->save()) {
            $result['status'] = 'ok';
            $result['redirect'] = '/schedule/manage';    
            $result['message'] = 'sucesso ao atualzar consulta';    
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao atualzar consulta';    
        }

        return response()->json($result);
    } 

    /**
     * 
     */
    public function delete($id) 
    {       
        $schedule = Schedule::find($id);   
        if ($schedule->delete())
            return response()->json([
                'status' => 'ok',
                'message' => 'sucesso ao deletar consulta'
            ]);  
        else
            return response()->json([
                'status' => 'error',
                'message' => 'erro ao deletar consulta'
            ]); 
    } 
}
