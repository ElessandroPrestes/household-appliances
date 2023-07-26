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

    public function findBrandById(int $id)
    {
        return $this->brandRepository->findBrandById($id);
    }

    public function updateBrand(int $id, array $brand)
    {
        return $this->brandRepository->updateBrand($id, $brand);
    }

    public function destroyBrand(int $id)
    {
        return $this->brandRepository->destroyBrand($id);
    }

}