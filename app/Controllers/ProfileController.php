<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class ProfileController extends ResourceController
{
    public function getUser($id = null){
        $user = new UserModel();
        $data = $user->where('verification_token', $id)->first();
        return $data['user_id'];
    }
    public function status($id = null)
    {
        $user = $this->getUser($id);
        $userModel = new UserModel();
        $userData = [
            'info' =>$userModel->select('username, full_name, email, bio, profile_picture_url')->find($user),
        ];
        
        if (!$userData) {   
            return $this->failNotFound('User not found');
        }
        return $this->respond($userData, 200);
    }   
    }
       