<?php

namespace App\Services;

use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;
    protected $brandRepository;

    public function __construct(ProductRepository $productRepository, BrandRepository $brandRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
    }

    public function createProduct(array $data)
    {
        $brand = $this->brandRepository->findBrandByUuid($data['brand']);
       
        return $this->productRepository->createProduct($brand->id, $data);
    }

}