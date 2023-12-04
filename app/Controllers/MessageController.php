<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;


class MessageController extends ResourceController
{
    public function Users()
    {
        $Users = new UserModel(); 
        $data = $Users->findAll();
        return $this ->respond($data ,200);
    }
}
