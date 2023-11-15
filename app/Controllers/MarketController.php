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
        $stores = $storeModel->findAll();

        // Retrieve and display a list of products
        $productModel = new ProductModel();
        $products = $productModel->findAll();

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
}
