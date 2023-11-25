<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use App\Models\StoreModel;
use App\Models\ProductModel;

class MarketController extends ResourceController
{
    public function getData()
    {
        // Retrieve and display a list of stores
        $storeModel = new StoreModel();
        $stores = $storeModel->find(1);

        // Retrieve and display a list of products
        $productModel = new ProductModel();
        $products = $productModel->find(1);

        // You might want to combine the data before responding
        $combinedData = [
            'stores' => $stores,
            'products' => $products,
        ];
    
        // Respond with the combined data
        return $this->respond($combinedData, 200);
        //check if there is a data in the data bse
        // var_dump($combinedData);
    }
        public function insertProduct(){
            $json = $this->request->getJSON();
            $data = [
        'media_url' =>$json->media_url,
        'product_name'=>$json->product_name,
        'description'=>$json->description,
        'price'=>$json->price,
            ];
            $evt = new ProductModel();
            $r=$evt->save($data);
            return $this->respond($r,200);
        }
    }
