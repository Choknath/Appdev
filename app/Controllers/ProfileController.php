<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class ProfileController extends ResourceController
{
    use ResponseTrait;

    public function updateProfile()
    {
        $input = $this->request->getJSON(true);

        $id = $input['id'];
        $dataToUpdate = [
            'full_name' => $input['full_name'],
            'email'     => $input['email'],
            'bio'       => $input['bio'],
            'profile_picture_url' => $input ['profile_picture_url']
            // Add other fields as needed
        ];

        $file = $this->request->getFile('file');

        // Check if the file is valid
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the file to a writable directory
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);

            // Save the file details to the database
            $model = new UserModel(); // Assuming you have a UserModel
            $id = $this->request->getPost('user_id'); // Assuming you send the user_id along with the file
            $model->update($id, ['profile_image' => $newName]); // Assuming 'profile_image' is the field in the database

            return $this->respond(['status' => 'success', 'message' => 'File uploaded and profile updated successfully']);
        } else {
            return $this->respond(['status' => 'error', 'message' => $file->getErrorString()]);
        }

        $model = new UserModel();
        $model->update($id, $dataToUpdate);

        return $this->respond(['status' => 'success', 'message' => 'Profile updated successfully']);
    }
    
    public function getUser($id = null)
    {
        $user = new UserModel();
        $data = $user->where('verification_token', $id)->first();
        return $data['user_id'];
    }

    public function status($id = null)
    {
        $user = $this->getUser($id);
        $userModel = new UserModel();
        $userData = [
            'info' => $userModel->select('username, full_name, email, bio, profile_picture_url')->find($user),
        ];

        if (!$userData) {
            return $this->failNotFound('User not found');
        }

        return $this->respond($userData, 200);
    }
  
}
