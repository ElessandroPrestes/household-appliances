<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function findAllBrands()
    {
        return $this->brandRepository->findAllBrands();
    }

    public function createBrand(array $brand)
    {
        return $this->brandRepository->createBrand($brand);
    }

    public function findBrandByUuid(string $uuid)
    {
        return $this->brandRepository->findBrandByUuid($uuid);
    }

    public function updateBrand(string $uuid, array $brand)
    {
        return $this->brandRepository->updateBrand($uuid, $brand);
    }

    public function destroyBrand(string $uuid)
    {
        return $this->brandRepository->destroyBrand($uuid);
    }

}