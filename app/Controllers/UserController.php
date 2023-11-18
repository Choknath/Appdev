<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class UserController extends ResourceController
{
    public function login()
    {
        $user = new UserModel(); 
    $username = $this->request->getVar('username'); 
     $password = $this->request->getVar('password'); 
     $data = $user->where('username', $username)->first(); 
     if($data){ 
       $pass = $data['password']; 
       $authenticatePassword = password_verify($password, $pass); 
       if($authenticatePassword){ 
         return $this->respond(['msg' => 'okay', 'token' =>$data['token']]); 
       }else{ 
         return $this->respond(['msg' => 'Invalid password'], 200); 
       } 
     } else{
        return $this->respond(['msg'=>'no user found']);
     }
    }

    public function register()
    {
        $user = new UserModel();
        $token = $this->verification(50); 
        $data = [ 
          'username' => $this->request->getVar('username'), 
          'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT), 
          'email' => $this->request->getVar('email'),
          'full_name' => $this->request->getVar('full_name'),
          'verification_token' => $token,    
          'status' => 'active', 
          'role' =>'user',
        ]; 
        $u = $user->save($data); 
        if($u){ 
          return $this->respond(['msg' => 'okay', 'token' =>$token]); 
        }else{ 
          return $this->respond(['msg' => 'failed']); 
        } 


        // // $json = $this->request->getJSON();
        // $data = [
        //     'username' => $this->request->getVar('username'),
        //     'email' => $this->request->getVar('email'),
        //     'full_name' => $this->request->getVar('full_name'),
        //     'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),   
        // ]; 
        // $Users = new UserModel(); 
        // $r = $Users->save($data);
        // return $this->respond($r, 200);
    
        // // Now you can use the $data array as needed, for example, save it to the database.
    }
    
    public function showuser()
    {
        $Users = new UserModel(); 
        $data = $Users->findAll();
        return $this ->respond($data ,200);
        // var_dump($data);
    } 

    public function verification($length){ 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
         return substr(str_shuffle($str_result), 0, $length); 
      } 
    
      
    
}
