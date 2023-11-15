<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use App\Models\UserModel;

class ProfileController extends ResourceController
{
    public function profData()
    {
        // Assuming you have a UserModel to interact with the 'users' table
        $userModel = new UserModel();

        // Find the user by user_id
        $user = $userModel->find($userId);

        if ($user) {
            // Extract the desired data (username, email, bio)
            $userData = [
                'username' => $user['username'],
                'email' => $user['email'],
                'bio' => $user['bio'],
            ];

            // Respond with the user data
            return $this->respond($userData, 200);
        } else {
            // If user is not found, respond with an error
            return $this->respond(['message' => 'User not found'], 404);
        }
    }
}





