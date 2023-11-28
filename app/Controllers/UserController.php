<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class UserController extends ResourceController
{

     // Function to handle user authentication and return user data
     private function authenticateUser($username, $password)
     {
         $userModel = new UserModel();
         $userData = $userModel->where('username', $username)->first();
 
         if ($userData && password_verify($password, $userData['password'])) {
             // Authentication successful
             return [
                 'user_id' => $userData['user_id'],
                 'username' => $userData['username'],
                 'full_name' => $userData['full_name'],
                 'email' => $userData['email'], 
                 // Add other relevant user data here
             ];
         } else {
             // Authentication failed
             return null;
         }
     }

    public function login()
    {
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = new UserModel();
        $data = $user->where('username',$username)->first();
       if ($data) {
        $pass = $data ['password'];
        $authenticatedPassword = password_verify($password,$pass);
        if ($authenticatedPassword) {
            return $this->respond(['msg'=>'okay','token' => $data['verification_token']],200);
        } else {
            return $this->respond(['msg'=>'Incorrect Password'],200);
        }
        
       } else {
        return $this->respond(['msg'=>'no user Found'],200);
       }
       
        // Authenticate the user
        $authenticatedUser = $this->authenticateUser($username, $password);
        if ($authenticatedUser) {
            return $this->respond(['msg' => 'okay', 'token' => $authenticatedUser['verification_token'], 'user' => $authenticatedUser], 200);
        } else {
            return $this->respond(['msg' => 'Invalid credentials'], 200);
        }
    }
    public function register()
    {
        $user = new UserModel();
    
        // Check if the email is already taken
        $existingUserEmail = $user->where('email', $this->request->getVar('email'))->first();
        if ($existingUserEmail) {
            return $this->respond(['msg' => 'failed', 'error' => 'email already taken']);
        }
    
        // Check if the username is already taken
        $existingUsername = $user->where('username', $this->request->getVar('username'))->first();
        if ($existingUsername) {
            return $this->respond(['msg' => 'failed', 'error' => 'username already taken']);
        }
    
        // Check if the full name is already taken
        $existingFullName = $user->where('full_name', $this->request->getVar('full_name'))->first();
        if ($existingFullName) {
            return $this->respond(['msg' => 'failed', 'error' => 'full name already taken']);
        }
    
        // Generate verification token
        $token = $this->generateVerificationToken(50);
    
        // Prepare data for user registration
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'full_name' => $this->request->getVar('full_name'),
            'verification_token' => $token,
            'status' => 'active',
            'role' => 'user',
        ];
    
        // Use a database transaction
        $user->transStart();
        try {
            $u = $user->save($data);
            $user->transComplete();
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $user->transRollback();
    
            // Log or handle the exception
            return $this->respond(['msg' => 'failed', 'error' => 'registration failed', 'exception' => $e->getMessage()]);
        }
    
        if ($user->transStatus() && $u) {
            return $this->respond(['msg' => 'okay', 'token' => $token]);
        } else {
            return $this->respond(['msg' => 'failed']);
        }
    }   
    
    public function checkUsernameAvailability()
    {
        $user = new UserModel();
        $username = $this->request->getVar('username');
        $existingUser = $user->where('username', $username)->first();
        $available = !$existingUser;
        return $this->respond(['available' => $available]);
    }
    
    public function checkEmailAvailability()
    {
        $user = new UserModel();
        $email = $this->request->getVar('email');
        $existingUser = $user->where('email', $email)->first();
        $available = !$existingUser;
        return $this->respond(['available' => $available]);
    }
        
        // public function checkFullNameAvailability()
        // {
        //     $user = new UserModel();
        //     $full_name = $this->request->getVar('full_name');
        //     $existingUser = $user->where('full_name', $full_name)->first();
        //     $available = !$existingUser;
        //     return $this->respond(['available' => $available]);
        // }
        
    private function generateVerificationToken($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
    
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $token;
    }
    
    public function showuser()
    {
        $Users = new UserModel(); 
        $data = $Users->findAll();
        return $this ->respond($data ,200);
        // var_dump($data);
    } 
    
    public function UpdateInfo()
    {
        
    }
      
    
    public function logout()
    {
        // Your logout logic here, e.g., destroying the session
        session()->destroy();

        // You can also redirect to the login page or any other page after logout
        return $this->response->setJSON(['message' => 'Logout successful']);
    }
    
}
