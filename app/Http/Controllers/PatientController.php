<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * 
     */
    public function new() 
    {
        return view('pages.patient.new', [
            'page' => 'patient-new',
            'page_title' => 'Novo Paciente'
        ]);
    }

    /**
     * 
     */
    public function manage()
    {
        return view('pages.patient.manage', [
            'page' => 'patient-manage',
            'page_title' => 'Gerenciar Pacientes'
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
            $result = Patient::orderBy('created_at','desc')             
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('jobtitle', 'like', '%' . $search . '%')
                    ->orWhere('cep', 'like', '%' . $search . '%')
                    ->orWhere('street', 'like', '%' . $search . '%')
                    ->orWhere('number', 'like', '%' . $search . '%')
                    ->orWhere('district', 'like', '%' . $search . '%')
                    ->orWhere('state', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%')
                    ->orWhere('cellphone', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->skip($start)
                    ->take($length)                    
                    ->get();            
            $response['recordsTotal'] = count($result);
            $response['recordsFiltered'] = count($result);            
        }
        else {
            $result = Patient::orderBy('created_at','desc')
                    ->skip($start)
                    ->take($length)
                    ->get();
            $response['recordsTotal'] = Patient::count();
            $response['recordsFiltered'] = Patient::count();    
        }

        $i = 0;
        foreach ($result as $res) {
            $actions = '
                <td class="actions text-right">
                    <a href="' . '/patient/edit/' . $res['id'] . '" class="btn btn-round btn-warning btn-icon btn-sm edit">
                        <i class="fas fa-edit"></i>                                        
                    </a>
                    <a href="' . '/patient/delete/' . $res['id'] . '" class="btn btn-round btn-danger btn-icon btn-sm remove">
                        <i class="fas fa-minus"></i>                                        
                    </a>
                </td>
            ';

            $data = [       
                ++$i,        
                $res['name'], 
                $res['lastname'], 
                $res['jobtitle'],
                $res['cep'],
                $res['street'],
                $res['number'],
                $res['district'],
                $res['state'],
                $res['city'],
                $res['cellphone'],
                $res['phone'],
                $res['email'],
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
        $patient = Patient::find($id); 
        return view('pages.patient.new', [
            'page' => 'patient-edit',
            'page_title' => 'Editar Paciente',
            'patient' => $patient
        ]);
    } 

    /**
     * 
     */
    public function create(Request $req) 
    {          
        $data = $req->all();    
        if (Patient::create($data)) {
            $result['status'] = 'ok';
            $result['message'] = 'sucesso ao criar paciente';
            $result['redirect'] = '/patient/manage';
            $result['data'] = $data;
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao tentar criar paciente';
        }
        return response()->json($result);  
    } 

        /**
     * 
     */
    public function update(Request $req, $id) 
    {                   
        $patient = Patient::find($id);    
        $patient->name       = $req->name; 
        $patient->lastname   = $req->lastname;
        $patient->jobtitle   = $req->jobtitle;
        $patient->cep        = $req->cep;    
        $patient->street     = $req->street;     
        $patient->number     = $req->number;         
        $patient->district   = $req->district;
        $patient->state      = $req->state;
        $patient->city       = $req->city;
        $patient->cellphone  = $req->cellphone;
        $patient->phone      = $req->phone;
        $patient->email      = $req->email;

        $result = [];         
        if ($patient->save()) {
            $result['status'] = 'ok';
            $result['redirect'] = '/patient/manage';    
            $result['message'] = 'sucesso ao atualzar paciente';    
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao atualzar paciente';    
        }

        return response()->json($result);
    } 

    /**
     * 
     */
    public function delete($id) 
    {       
        $patient = Patient::find($id);   
        if ($patient->delete())
            return response()->json([
                'status' => 'ok',
                'message' => 'sucesso ao deletar paciente'
            ]);  
        else
            return response()->json([
                'status' => 'error',
                'message' => 'erro ao deletar paciente'
            ]); 
    } 
}
