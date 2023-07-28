<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function createProduct(int $brandId, array $data);
}