<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use App\Models\StoreModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class MarketController extends ResourceController
{
  
    public function getItmes(){
        $ent = new ProductModel();
        $data = $ent->findAll();
        return $this->respond($data, 200);
    }


    public function insertProduct()
{
    $user = new UserModel(); 
    $json = $this->request->getJSON();
    $u = $user->where('verification_token', $json->verification_token)->first();

    $data = [
        'user_id' => $u['user_id'],
        'media_url' => $json->product_image_url,
        'product_name' => $json->product_name,
        'description' => $json->product_description,
        'price' => $json->product_price,
    ];

    $productModel = new ProductModel();
    $response = $productModel->save($data);

    return $this->respond($response, 200);
    }

     //sasarili mong Post na evenna makikita sa profile mo 
     public function ownitems($id = null){
        $post = new ProductModel();
        $cnt = $post->join('users', 'products.product_id=users.user_id')->where('verification_token', $id)->findAll();
        return $this->respond($cnt, 200);
    }

    }
