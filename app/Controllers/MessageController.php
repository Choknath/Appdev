<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\MessageModel;

class MessageController extends ResourceController
{
    public function sendMessage()
    {   
        $user = new UserModel();
        $json = $this->request->getJSON();
        $sender = $user->where('verification_token', $json->verification_token)->first();

        $data = [
            'sender_id' => $sender['user_id'],
            'receiver_id' => $json->receiver_id,
            'message_text' => $json->message_text,
        ];

        $messageModel = new MessageModel();

        $r = $messageModel->save($data);

        if ($r) {   
            return $this->respondCreated(['status' => 'Message sent successfully']);
        } else {
            return $this->fail('Failed to send message', 500);
        }
    }

    public function fetchMessages($userId = null)
    {
        $lastFetchTimestamp = $this->request->getVar('last_fetch_timestamp');
        $messageModel = new MessageModel();

        $messages = $messageModel
            ->where('receiver_id', $userId)
            ->orWhere('sender_id', $userId)
            ->where('sent_at >', $lastFetchTimestamp)
            ->orderBy('sent_at', 'ASC')
            ->findAll();

        return $this->respond($messages, 200);
    }
}
