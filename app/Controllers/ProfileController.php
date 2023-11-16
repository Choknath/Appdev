<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use App\Models\UserModel;

class ProfileController extends ResourceController
{
    public function Status()
    {
        // $userModel = new UserModel();
    
        // $userData = $userModel->where('username','email','bio') ->Find();  
    
        // return $this->respond($userData, 200);
        // // var_dump($userData);


        $userModel = new UserModel();
    
        $userdata = $userModel->select('username, email, bio')->findAll();    

        return $this->respond($userdata, 200);
        // var_dump($userData);
    }
}
    

