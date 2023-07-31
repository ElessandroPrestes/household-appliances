<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($brand)
    {
        $products = $this->productService->findAllProductByBrand($brand);

        return response([
            'data' => ProductResource::collection($products),
            'message' => 'Products Successfully listed'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, $brand)
    {
        $product = $this->productService->createProduct($request->validated());
        
        return response([
            'data'=>new ProductResource($product),
            'message' => 'Prodcut Register successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param string $uuid
     */
    public function show($brand, $uuid)
    {
        $brand = $this->productService->findProductByBrand($brand, $uuid);

        return response([
            'data'=>new ProductResource($brand),
            'message' => 'Product By Brand successfully listed'
       ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param string $uuid
     */
    public function update(UpdateProductRequest $request,$brand, $uuid)
    {
        $this->productService->updateProduct($request->validated(), $uuid);

        return response([
            'message' =>    'Product By Brand Updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $uuid
     */
    public function destroy($brand,$uuid)
    {
        $this->productService->deleteProduct($uuid);

        return response([], 204);
    }
}
