<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\brandId;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $modelProduct;

    public function __construct(Product $product)
    {
        $this->modelProduct = $product;
    }

    public function findProductByBrand(int $brandId)
    {
        return $this->modelProduct
                                ->where('brand_id', $brandId)
                                ->get();
    }

    public function createProduct(int $brandId, array $data)
    {
        $data['brand_id'] = $brandId;
        
        return $this->modelProduct->create($data);
        

    }
}