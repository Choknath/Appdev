<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\PostModel;

class PostController extends ResourceController {

    public function PostContent(){
        $user = new PostModel();
        $data = [
            'content'=>$this->request->getVar('content'),
            'media_url'=> $this ->request -> getVar('media_url')
        ];
        $user->save($data);
    }
    public function getPost($id = null){
        $post = new PostModel();
        $cnt = $post->join('users', 'posts.user_id=users.user_id')->where('verification_token', $id)->findAll();
        return $this->respond($cnt, 200);
    }

    public function ContentPost(){
        $cont = new PostModel();
        $pst = $cont->findall();
        return $this->respond($pst, 200);
    }

}

