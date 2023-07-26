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

}