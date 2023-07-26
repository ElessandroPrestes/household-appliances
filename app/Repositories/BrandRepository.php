<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    protected $modelBrand;

    public function __construct(Brand $brand)
    {
        $this->modelBrand = $brand;
    }

    public function createBrand(array $brand)
    {
        return $this->modelBrand->create($brand);
    }
}