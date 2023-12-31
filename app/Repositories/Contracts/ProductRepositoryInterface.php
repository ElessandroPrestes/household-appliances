<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function findAllProductByBrand(int $brandId);

    public function createProduct(int $brandId, array $data);

    public function findProductByUuid(string $uuid);

    public function findProductByBrand(int $brandId, string $uuid);

    public function updateProductByBrand(int $brandId, string $uuid, array $data);

    public function deleteProductByBrand(string $uuid);

}