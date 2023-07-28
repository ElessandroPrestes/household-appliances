<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
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
<<<<<<< HEAD
    public function index()
    {
        //
=======
    public function index($brand)
    {
        $products = $this->productService->findProductByBrand($brand);

        return response([
            'data' => ProductResource::collection($products),
            'message' => 'Products Successfully listed'
        ], 200);
>>>>>>> dev
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
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
