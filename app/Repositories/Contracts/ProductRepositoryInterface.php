<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function findProductByBrand(int $brandId);

    public function createProduct(int $brandId, array $data);
}