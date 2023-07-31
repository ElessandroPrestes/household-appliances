<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Services\BrandService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      title="Household appliances",
 *      version="1.0.0",
 *      description="API for household appliances",
 *      @OA\Contact(
 *          email="elessandrodev@gmail.com"
 *      ),
 *      @OA\License(
 *          name="MIT"
 *      )
 * )
 */
class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
     * @OA\Get(
     *      path="/api/v1/brands",
     *      operationId="findAllBrands",
     *      tags={"brands"},
     *      description="Returns list of brands",
     *      @OA\Response(
     *          response=200,
     *          description="Brands Successfully listed."
     *       )
     *     ),
     *      @OA\Server(
     *          url="http://localhost:8000",
     * 
     *      )
     *
     *@return BrandResource[]
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
    * @OA\Post(
    *      path="/api/v1/brands",
    *      tags={"brands"},
    *      description="Create brand",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *          type="object",
    *          @OA\Property(property="name", type="string", example="Samsung"),
    *       )
    *     ),
    *      @OA\Response(
    *          response=201, description="Brand Register successfully."
    *      )
    *     ),
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
    * @OA\Get(
    *     path="/api/v1/brands/{uuid}", 
    *     tags={"brands"},
    *     description="Retrieve a Brand by UUID.",
    *     operationId="findBrandByUuid",
    *     @OA\Parameter(
    *         name="brandUuid", 
    *         in="path", 
    *         required=true, 
    *         description="UUID of the brand to be retrieved.",
    *         @OA\Schema(
    *             type="string" 
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Brand Successfully listed.",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                 property="id",
    *                 type="integer",
    *                 example=1
    *             ),
    *             @OA\Property(
    *                 property="name",
    *                 type="string",
    *                 example="Brand Name"
    *             ),
    *             @OA\Property(
    *                 property="description",
    *                 type="string",
    *             ),
    *            
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Brand Not Found"
    *     ),
    * )
    */
    
    public function show(string $uuid)
    {
        $brand = $this->brandService->findBrandByUuid($uuid);

        return response([
            'data'     =>  new BrandResource($brand),
            'message'  =>  'Brand Successfully listed'
       ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/brands/{uuid}",
     *     tags={"brands"},
     *     description="Update Brand by UUID",
     *     operationId="updateBrandByUuid",
     *     @OA\Parameter(
     *         name="uuid", 
     *         in="path", 
     *         required=true, 
     *         description="UUID of the brand to be updated.",
     *         @OA\Schema(
     *             type="string" 
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name", 
     *                     type="string", 
     *                     example="New Brand" 
     *                 ),
     *                 @OA\Property(
     *                     property="description", 
     *                     type="string",
     *                     example="Updated Brand"
     *                 ),
     *              
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand successfully updated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Brand successfully updated."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Brand Not Found"
     *     ),
     * )
     */
   
    public function update(UpdateBrandRequest $request,string $uuid)
    {
        $this->brandService->updateBrand($uuid, $request->validated());

        return response([
            'message' =>    'Brand Updated successfully'
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/brands/{uuid}",
     *     tags={"brands"},
     *     description="Delete a brand by UUID.",
     *     operationId="deleteBrandByUuid",
     *     @OA\Parameter(
     *         name="uuid", 
     *         in="path", 
     *         required=true, 
     *         description="UUID of the Brand to be deleted.",
     *         @OA\Schema(
     *             type="string" 
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand successfully deleted",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Brand successfully deleted"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Brand Not Found"
     *     ),
     * )
     */

    public function destroy(string $uuid)
    {
        $this->brandService->destroyBrand($uuid);

        return response([], 204);
    }
}
