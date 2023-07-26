<?php

namespace App\Repositories\Contracts;

interface BrandRepositoryInterface
{

    public function findAllBrands();
    
    public function createBrand(array $brand);

    public function findBrandById($id);

    public function updateBrand($id, array $brand);

}