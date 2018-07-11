<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendant;
use App\Models\User;
use Faker\Factory as Faker;

class AttendantController extends Controller
{
    /**
     * 
     */
    public function new() 
    {
        return view('pages.attendant.new', [
            'page' => 'attendant-new',
            'page_title' => 'Novo Atendente'
        ]);
    }

    /**
     * 
     */
    public function manage()
    {
        return view('pages.attendant.manage', [
            'page' => 'attendant-manage',
            'page_title' => 'Gerenciar Atendentes'
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
            $result = Attendant::orderBy('created_at','desc')             
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
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
            $result = Attendant::orderBy('created_at','desc')
                    ->skip($start)
                    ->take($length)
                    ->get();
            $response['recordsTotal'] = Attendant::count();
            $response['recordsFiltered'] = Attendant::count();    
        }

        $i = 0;
        foreach ($result as $res) {
            $actions = '
                <td class="actions text-right">
                    <a href="' . '/attendant/edit/' . $res['id'] . '" class="btn btn-round btn-warning btn-icon btn-sm edit">
                        <i class="fas fa-edit"></i>                                        
                    </a>
                    <a href="' . '/attendant/delete/' . $res['id'] . '" class="btn btn-round btn-danger btn-icon btn-sm remove">
                        <i class="fas fa-minus"></i>                                        
                    </a>
                </td>
            ';

            $data = [       
                ++$i,        
                $res['name'], 
                $res['lastname'], 
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
        $attendant = Attendant::find($id); 
        return view('pages.attendant.new', [
            'page' => 'attendant-edit',
            'page_title' => 'Editar Atendente',
            'attendant' => $attendant
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
            if (Attendant::create($data)) {
                $result['status'] = 'ok';
                $result['message'] = 'sucesso ao criar atendente';
                $result['redirect'] = '/attendant/manage';
                $result['data'] = $data;
            }
            else {
                $result['status'] = 'error';
                $result['message'] = 'erro ao tentar criar atendente';
            }
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao tentar criar atendente';
        }

        return response()->json($result);  
    } 

        /**
     * 
     */
    public function update(Request $req, $id) 
    {                   
        $attendant = Attendant::find($id);    
        $attendant->name       = $req->name; 
        $attendant->lastname   = $req->lastname;
        $attendant->cep        = $req->cep;    
        $attendant->street     = $req->street;     
        $attendant->number     = $req->number;         
        $attendant->district   = $req->district;
        $attendant->state      = $req->state;
        $attendant->city       = $req->city;
        $attendant->cellphone  = $req->cellphone;
        $attendant->phone      = $req->phone;
        $attendant->email      = $req->email;

        $result = [];         
        if ($attendant->save()) {
            $result['status'] = 'ok';
            $result['redirect'] = '/attendant/manage';    
            $result['message'] = 'sucesso ao atualzar atendente';    
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao atualzar atendente';    
        }

        return response()->json($result);
    } 

    /**
     * 
     */
    public function delete($id) 
    {       
        $attendant = Attendant::find($id);  
        if (User::find($attendant->user)->delete())
            if ($attendant->delete())
                return response()->json([
                    'status' => 'ok',
                    'message' => 'sucesso ao deletar atendente'
                ]);  
            else
                return response()->json([
                    'status' => 'error',
                    'message' => 'erro ao deletar atendente'
                ]);         
        else 
            return response()->json([
                'status' => 'error',
                'message' => 'erro ao deletar atendente'
            ]); 
    } 
}
