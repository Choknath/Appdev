<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RestFul\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\PostModel;

class AuthController extends ResourceController
{
    public function getData()
    {

        $user = new UserModel();
        $user = $user->findAll();


        return $this->respond($user, 200);
        
        
    }
}

