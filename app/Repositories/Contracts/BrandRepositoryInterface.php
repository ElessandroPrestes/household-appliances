<?php

namespace App\Repositories\Contracts;

interface BrandRepositoryInterface
{

    public function findAllBrands();
    
    public function createBrand(array $product);

    public function findBrandById($id);

}