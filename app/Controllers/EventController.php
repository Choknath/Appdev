<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EventModel;

class EventController extends ResourceController
{
    public function getevent(){
        $ent = new EventModel();
        $data = $ent->findAll();
        return $this->respond($data, 200);
    }
    public function addEvent()
    {
        // Get the logged-in user's ID. Adjust this based on your authentication mechanism.
        $user_id = 'user_id'; // Replace with the actual user ID
    
        $json = $this->request->getJSON();
        $data = [
            'event_name' => $json->event_name,
            'event_description' => $json->event_description,
            'event_date' => $json->event_date,
            'event_location' => $json->event_location,
            'event_image_url' => $json->event_image_url,
            'user_id' => $user_id, // Add the user_id to associate the event with a user
        ];
    
        $evt = new EventModel();
        $r = $evt->save($data);
    
        return $this->respond($r, 200);
    }
    
    public function postEvent($id = null){
        $post = new EventModel();
        $cnt = $post->join('users', 'events.user_id=users.user_id')->where('verification_token', $id)->findAll();
        return $this->respond($cnt, 200);
    }


    
}