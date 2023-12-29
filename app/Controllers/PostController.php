<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\CommentsModel;
use App\Models\LikeModel;

class PostController extends ResourceController {

    //ito at para sa profile
    public function getPost($id = null){
        $post = new PostModel();
        $cnt = $post->join('users', 'posts.user_id=users.user_id')->where('verification_token', $id)->findAll();
        return $this->respond($cnt, 200);
    }

    //ito naman ay para sa community
    public function ContentPost(){
        $cont = new PostModel();
        $pst = $cont->join('users','posts.user_id=users.user_id', 'inner')->findall();
        return $this->respond($pst, 200);
    }

    //sa pag add ng post
    public function PostMedia(){
        $user = new UserModel();
        $json = $this->request->getJSON();
        $u = $user->where('verification_token', $json->verification_token)->first();
        
        $data = [
            'user_id' => $u['user_id'],
            'content' => $json->content,
            'mediaUrl' => $json->mediaUrl, 
        ];
    
        $evt = new PostModel();
        $r = $evt->save($data);
           
        return $this->respond($r, 200);
      }

      
    // Handle liking a post
    public function likePost($postId, $userId)
    {
        $likeModel = new LikeModel();
        $likeModel->save(['user_id' => $userId, 'post_id' => $postId]);

        return $this->respond(['message' => 'Post liked successfully']);
    }

    // Handle submitting a comment
    public function submitComment($postId, $userId, $commentText)
    {
        $commentModel = new CommentModel();
        $commentModel->save(['user_id' => $userId, 'post_id' => $postId, 'comment_text' => $commentText]);

        return $this->respond(['message' => 'Comment submitted successfully']);
    }

    

    

}

