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
        Cache::forget('brand:all');
        
        return $this->modelBrand->get();
        

    }

    public function createBrand(array $brand)
    {
        return $this->modelBrand->create($brand);
    }

    public function findBrandByUuid(string $uuid)
    {
        try {
            
            $brand = $this->modelBrand->where('uuid',$uuid)->firstOrFail();
            
            return $brand;

        } catch (\Throwable $th ) {

            throw new NotFoundHttpException('Brand Not Found');

        }
      
    }

    public function updateBrand($uuid, array $brand)
    {
        $edit = $this->findBrandByUuid($uuid);

        Cache::forget('brand:all');

        return $edit->update($brand);

    }

    public function destroyBrand($uuid)
    {
        $delete = $this->findBrandByUuid($uuid);

        Cache::forget('brand:all');

        return $delete->delete();
    }

}