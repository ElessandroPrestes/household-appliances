<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function findBrandById($id)
    {
        try {
            
            $brand = $this->modelBrand->where('id',$id)->firstOrFail();

            return $brand;

        } catch (\Throwable $th ) {

            throw new NotFoundHttpException();

        }
      
    }
}