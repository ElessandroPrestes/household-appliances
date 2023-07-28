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

    public function findAllProductByBrand(string $brand)
    {
        $brand = $this->brandRepository->findBrandByUuid($brand);

        return $this->productRepository->findAllProductByBrand($brand->id);
    }

    public function createProduct(array $data)
    {
        $brand = $this->brandRepository->findBrandByUuid($data['brand']);
       
        return $this->productRepository->createProduct($brand->id, $data);
    }

    public function findProductByBrand(string $brand, string $uuid)
    {
        $brand = $this->brandRepository->findBrandByUuid($brand);

        return $this->productRepository->findProductByBrand($brand->id, $uuid);
    }

}