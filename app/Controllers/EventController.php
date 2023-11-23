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
        $json = $this->request->getJSON();
        $data = [
    'event_name' =>$json->event_name,
    'event_description'=>$json->event_description,
    'event_date'=>$json->event_date,
    'event_location'=>$json->event_location,
    'event_image_url'=>$json->event_image_url,
        ];
        $evt = new EventModel();
        $r=$evt->save($data);
        return $this->respond($r,200);
    }
}