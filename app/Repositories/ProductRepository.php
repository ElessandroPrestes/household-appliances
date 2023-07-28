<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $modelProduct;

    public function __construct(Product $product)
    {
        $this->modelProduct = $product;
    }

    public function createProduct(int $brandId, array $data)
    {
        $data['brand_id'] = $brandId;
        
        return $this->modelProduct->create($data);
        

    }
}