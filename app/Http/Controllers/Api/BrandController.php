<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandService->findAllBrands();

        return response([
            'data' => BrandResource::collection($brands),
            'message' => 'Brands Successfully listed'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = $this->brandService->createBrand($request->validated());

        return response([
            'data'=>new BrandResource($brand),
            'message' => 'Brand Register successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param string $uuid
     */
    public function show($uuid)
    {
        $brand = $this->brandService->findBrandByUuid($uuid);

        return response([
            'data'     =>  new BrandResource($brand),
            'message'  =>  'Brand Successfully listed'
       ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param @param string $uuid
     */
    public function update(UpdateBrandRequest $request,$uuid)
    {
        $this->brandService->updateBrand($uuid, $request->validated());

        return response([
            'message' =>    'Brand Updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param @param string $uuid
     */
    public function destroy($uuid)
    {
        $this->brandService->destroyBrand($uuid);

        return response([], 204);
    }
}
