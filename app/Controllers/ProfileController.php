<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class ProfileController extends ResourceController
{
    public function status()
    {
        //    // Check if the user is authenticated
        //    if (!session()->has('user_id')) {
        //     return $this->failUnauthorized('User not authenticated');
        // }

        // Get the current user's ID from the session
        $userId = session('user_id');

        $userModel = new UserModel();
        $userData = $userModel->select('username, full_name, email, bio, profile_picture_url')->find($userId);

        if (!$userData) {
            return $this->failNotFound('User not found');
        }

        return $this->respond($userData, 200);


        // $userModel = new UserModel();
        // // $userId = getUserId(); // You need to implement a way to get the user ID (e.g., from authentication)

        // $userData = $userModel->select('username, full_name, email, bio, profile_picture_url')->find();

        // if (!$userData) {
        //     return $this->failNotFound('User not found');
        // }
        // return $this->respond($userData, 200);

        // $userModel = new UserModel();
        // $userdata = $userModel->findAll();    
        // return $this->respond($userdata, 200);
        // // var_dump($userdata);
    }
}



