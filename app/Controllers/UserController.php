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
        
    }

    public function register()
    {
        $json = $this->request->getJSON();
        $data = [
            'username' => $json->username,
            'email' => $json->email, 
            'full_name' => $json->full_name,
            'password' => $json->password,
        ]; 
        $Users = new UserModel(); 
        $r = $Users->save($data);
        return $this->respond($r, 200);
    
        // Now you can use the $data array as needed, for example, save it to the database.
    }
    
    public function showuser()
    {
        $Users = new UserModel(); 
        $data = $Users->findAll();
        return $this ->respond($data ,200);
        // var_dump($data);
    }
    
}
