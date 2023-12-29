<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EventModel;
use App\Models\UserModel;
class EventController extends ResourceController
{
    //pag kuha lahat ng events na nalagay ng mga users
    public function getevent(){
        $ent = new EventModel();
        $data = $ent->findAll();
        // return $this->respond($data, 200);
        var_dump ($data);
    }

    //pag aad ng event sa Event page 
    public function addEvent()
    {
      
        $user = new UserModel();
        $json = $this->request->getJSON();
        $u = $user->where('verification_token', $json->verification_token)->first();
        
        $data = [
            'user_id' => $u['user_id'],
            'event_name' => $json->event_name,
            'event_description' => $json->event_description,
            'event_date' => $json->event_date,
            'event_location' => $json->event_location,
            'event_image_url' => $json->event_image_url,
         
        ];  
    
        $evt = new EventModel();
        $r = $evt->save($data);
    //          return $this->respond($r, 200);//
    var_dump ($data);
 
     }
        
    
    //sasarili mong Post na evenna makikita sa profile mo 
    public function postEvent($id = null){
        $post = new EventModel();
        $cnt = $post->join('users', 'events.user_id=users.user_id')->where('verification_token', $id)->findAll();
        return $this->respond($cnt, 200);
    }
}