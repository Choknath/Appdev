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
    
        $existingUser = $user->where('email', $this->request->getVar('email'))->first();
        if ($existingUser) {
            return $this->respond(['msg' => 'failed', 'error' => 'email already taken']);
        }
    
        $token = $this->generateVerificationToken(50);
    
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'full_name' => $this->request->getVar('full_name'),
            'verification_token' => $token,
            'status' => 'active',
            'role' => 'user',
        ];
    
        try {
            $u = $user->save($data);
        } catch (\Exception $e) {
            // Log or handle the exception
            return $this->respond(['msg' => 'failed', 'error' => 'registration failed']);
        }
    
        if ($u) {
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
    
    private function generateVerificationToken($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
    
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $token;
    }
    


    // public function register()
    // {
    //     $user = new UserModel();

    //     // Check if the username already exists
    //     $existingUser = $user->where('email', $this->request->getVar('email'))->first();
    //     if ($existingUser) {
    //         // Username already exists
    //         return $this->respond(['msg' => 'failed', 'error' => 'email already taken']);
    //     }
    
    //     // Generate a verification token
    //     $token = $this->verification(50);
    
    //     // Prepare data for user registration
    //     $data = [
    //         'username' => $this->request->getVar('username'),
    //         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    //         'email' => $this->request->getVar('email'),
    //         'full_name' => $this->request->getVar('full_name'),
    //         'verification_token' => $token,
    //         'status' => 'active',
    //         'role' => 'user',
    //     ];
    
    //     // Save the user data
    //     $u = $user->save($data);
    
    //     if ($u) {
    //         // Registration successful
    //         return $this->respond(['msg' => 'okay', 'token' => $token]);
    //     } else {
    //         // Registration failed
    //         return $this->respond(['msg' => 'failed']);
    //     }
    
    // }
    
    public function showuser()
    {
        $Users = new UserModel(); 
        $data = $Users->findAll();
        return $this ->respond($data ,200);
        // var_dump($data);
    } 
    
    public function UpdateInfo()
    {
        // logic para sa pag uupdata ng username, email, bio , password,
    }
      
    
}
