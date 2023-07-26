<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class BrandRepository implements BrandRepositoryInterface
{
    protected $modelBrand;

    public function __construct(Brand $brand)
    {
        $this->modelBrand = $brand;
    }

    public function findAllBrands()
    {
        return Cache::rememberForever('brand', function(){
            return $this->modelBrand->get();
        });
    }

    public function createBrand(array $brand)
    {
        return $this->modelBrand->create($brand);
    }
}