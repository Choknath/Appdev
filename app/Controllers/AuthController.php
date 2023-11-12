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
        // Retrieve data in the databse
        $user = new UserModel();
        $user = $user->findAll();

        // Return the user data in the database as JSON
        return $this->respond($user, 200);
        
        // this will check if the database ay may laman
        // var_dump($user);
    }
}

