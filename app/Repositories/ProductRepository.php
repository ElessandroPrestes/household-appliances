<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository implements ProductRepositoryInterface
{
    protected $modelProduct;

    public function __construct(Product $product)
    {
        $this->modelProduct = $product;
    }

    public function findAllProductByBrand(int $brandId)
    {
        return $this->modelProduct
                                ->where('brand_id', $brandId)
                                ->get();
    }

    public function createProduct(int $brandId, array $data)
    {
        $data['brand_id'] = $brandId;
        
        return $this->modelProduct->create($data);
        
    }

    public function findProductByUuid(string $uuid)
    {
        return $this->modelProduct
                    ->where('uuid', $uuid)
                    ->firstOrfail();
    }

    public function findProductByBrand(int $brandId, string $uuid)
    {
        try {
            $productBrand  = $this->modelProduct
                                ->where('brand_id', $brandId)
                                ->where('uuid', $uuid)
                                ->firstOrfail();
                                
            return $productBrand;

        } catch (\Throwable $th) { 

            throw new NotFoundHttpException('Brand By Product Not Found');
        }
        
    }

    public function updateProductByBrand(int $brandId, string $uuid, array $data)
    {
        $product = $this->findProductByUuid($uuid);

        Cache::forget('product:all');

        $data['brand_id'] = $brandId;

        return $product->update($data);
 
    }
}