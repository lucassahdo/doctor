<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Faker\Factory as Faker;

class DoctorController extends Controller
{
    /**
     * 
     */
    public function new() 
    {
        return view('pages.doctor.new', [
            'page' => 'doctor-new',
            'page_title' => 'Novo Médico'
        ]);
    }

    /**
     * 
     */
    public function manage()
    {
        return view('pages.doctor.manage', [
            'page' => 'doctor-manage',
            'page_title' => 'Gerenciar Médicos'
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
            $result = Doctor::orderBy('created_at','desc')             
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('function', 'like', '%' . $search . '%')
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
            $result = Doctor::orderBy('created_at','desc')
                    ->skip($start)
                    ->take($length)
                    ->get();
            $response['recordsTotal'] = Doctor::count();
            $response['recordsFiltered'] = Doctor::count();    
        }

        $i = 0;
        foreach ($result as $res) {
            $actions = '
                <td class="actions text-right">
                    <a href="' . '/doctor/edit/' . $res['id'] . '" class="btn btn-round btn-warning btn-icon btn-sm edit">
                        <i class="fas fa-edit"></i>                                        
                    </a>
                    <a href="' . '/doctor/delete/' . $res['id'] . '" class="btn btn-round btn-danger btn-icon btn-sm remove">
                        <i class="fas fa-minus"></i>                                        
                    </a>
                </td>
            ';

            $data = [       
                ++$i,        
                $res['name'], 
                $res['lastname'], 
                $res['function'],
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
        $doctor = Doctor::find($id); 
        return view('pages.doctor.new', [
            'page' => 'doctor-edit',
            'page_title' => 'Editar Médico',
            'doctor' => $doctor
        ]);
    } 

    /**
     * 
     */
    public function create(Request $req) 
    {          
        $data = $req->all();    
        $faker = Faker::create();
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($faker->word),
            'level' => 2
        ]);

        if ($user) {
            $data['user'] = $user->id;
            if (Doctor::create($data)) {
                $result['status'] = 'ok';
                $result['message'] = 'sucesso ao criar médico';
                $result['redirect'] = '/doctor/manage';
                $result['data'] = $data;
            }
            else {
                $result['status'] = 'error';
                $result['message'] = 'erro ao tentar criar médico';
            }
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao tentar criar médico';
        }

        return response()->json($result);  
    } 

        /**
     * 
     */
    public function update(Request $req, $id) 
    {                   
        $doctor = Doctor::find($id);    
        $doctor->name       = $req->name; 
        $doctor->lastname   = $req->lastname;
        $doctor->function   = $req->function;
        $doctor->cep        = $req->cep;    
        $doctor->street     = $req->street;     
        $doctor->number     = $req->number;         
        $doctor->district   = $req->district;
        $doctor->state      = $req->state;
        $doctor->city       = $req->city;
        $doctor->cellphone  = $req->cellphone;
        $doctor->phone      = $req->phone;
        $doctor->email      = $req->email;

        $result = [];         
        if ($doctor->save()) {
            $result['status'] = 'ok';
            $result['redirect'] = '/doctor/manage';    
            $result['message'] = 'sucesso ao atualzar médico';    
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao atualzar médico';    
        }

        return response()->json($result);
    } 

    /**
     * 
     */
    public function delete($id) 
    {       
        $doctor = Doctor::find($id);  
        if (User::find($doctor->user)->delete())
            if ($doctor->delete())
                return response()->json([
                    'status' => 'ok',
                    'message' => 'sucesso ao deletar médico'
                ]);  
            else
                return response()->json([
                    'status' => 'error',
                    'message' => 'erro ao deletar médico'
                ]);         
        else 
            return response()->json([
                'status' => 'error',
                'message' => 'erro ao deletar médico'
            ]); 
    } 
}
