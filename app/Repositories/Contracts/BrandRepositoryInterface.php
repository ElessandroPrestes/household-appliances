<?php

namespace App\Repositories\Contracts;

interface BrandRepositoryInterface
{

    public function findAllBrands();
    
    public function createBrand(array $brand);

    public function findBrandByUuid(string $uuid);

    public function updateBrand($id, array $brand);

    public function destroyBrand(string $uuid);

}