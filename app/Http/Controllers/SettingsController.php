<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Crypt;

class SettingsController extends Controller 
{
    /**
     * 
     */
    public function preferences() 
    {        
        return view('pages.settings.preferences', [
            'page' => 'settings-preferences',
            'page_title' => 'Preferências'
        ]);
    }

    /**
     * 
     */
    public function user_new() 
    {
        return view('pages.settings.user', [
            'page' => 'user-new',
            'page_title' => 'Novo Usuário'
        ]);
    }

    /**
     *
     */
    public function user_profile($user_id) 
    {
        $user = [];
        $user = User::find(Auth::user()->id)->toArray();
        $user['title'] = $user['name'] . ' ' . $user['lastname'];   
        return view('pages.settings.user', [
            'user_id' => $user_id,
            'page' => 'settings-user',
            'page_title' => 'Perfil',
            'user' => (object) $user
        ]);
    }

    /**
     * 
     */
    public function users() 
    {
        return view('pages.settings.users', [
            'page' => 'settings-users',
            'page_title' => 'Usuários'
        ]);
    }    

    /**
     * 
     */
    public function user_edit($id) {
        $user = User::find($id); 
        return view('pages.settings.user', [
            'page' => 'user-edit',
            'page_title' => 'Editar Usuário',
            'user' => $user
        ]);
    } 

    /**
     * 
     */
    public function user_table(Request $req)
    {     
        $start = (int) $req->start;
        $length = ($req->length !== -1) ? (int) $req->length : 50;   
        $search = (isset($req->search['value']) && strlen($req->search['value']) > 0) ? $req->search['value'] : false;

        $response = [];
        $response['draw'] = 0;
        $response['data'] = [];
        if ($search) {
            $result = User::orderBy('created_at','desc')             
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('level', 'like', '%' . $search . '%')                  
                    ->skip($start)
                    ->take($length)                    
                    ->get();            
            $response['recordsTotal'] = count($result);
            $response['recordsFiltered'] = count($result);            
        }
        else {
            $result = User::orderBy('created_at','desc')
                    ->skip($start)
                    ->take($length)
                    ->get();
            $response['recordsTotal'] = User::count();
            $response['recordsFiltered'] = User::count();    
        }

        $i = 0;
        foreach ($result as $res) {
            $actions = '
                <td class="actions text-right">
                    <a href="' . '/settings/user/edit/' . $res['id'] . '" class="btn btn-round btn-warning btn-icon btn-sm edit">
                        <i class="fas fa-edit"></i>                                        
                    </a>
                    <a href="' . '/settings/user/delete/' . $res['id'] . '" class="btn btn-round btn-danger btn-icon btn-sm remove">
                        <i class="fas fa-minus"></i>                                        
                    </a>
                </td>
            ';

            $data = [       
                ++$i,        
                $res['name'], 
                $res['lastname'],               
                $res['email'],
                $res['level'],
                $actions
            ];
            $response['data'][] = $data;
        }   
        return response()->json($response);
    }

    /**
     * 
     */
    public function user_create(Request $req) 
    {          
        $data = $req->all();   

        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'level' => 3
        ]);

        if ($user) {
            $result['status'] = 'ok';
            $result['message'] = 'sucesso ao criar usuário';
            $result['redirect'] = '/settings/users';
            $result['data'] = $data;            
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao tentar criar usuário';
        }

        return response()->json($result);  
    } 

    /**
     * 
     */
    public function user_update(Request $req, $id) 
    {      
        $user = User::find($id);    
        $user->name       = $req->name; 
        $user->lastname   = $req->lastname;     
        $user->email      = $req->email;
        $user->level      = 3;

        if (isset($req->password) && isset($req->_password)) {            
            if ($req->password === $req->_password) {
                $user->password = bcrypt($req->password);
            }
            else {
                $result['status'] = 'warning';
                $result['message'] = 'senhas diferentes digitadas';   
                return response()->json($result);
            }
        }

        $result = [];         
        if ($user->save()) {
            $result['status'] = 'ok';
            $result['redirect'] = '/settings/users';    
            $result['message'] = 'sucesso ao atualzar usuário';    
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'erro ao atualzar usuário';    
        }

        return response()->json($result);
    } 

    /**
     * 
     */
    public function user_delete($id) 
    {       
        $user = User::find($id);  
        if ($user->delete())
            return response()->json([
                'status' => 'ok',
                'message' => 'sucesso ao deletar usuário'
            ]);  
        else
            return response()->json([
                'status' => 'error',
                'message' => 'erro ao deletar usuário'
            ]);             
    } 
}
