<?php

namespace Tests\Feature\Repositories;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use App\Repositories\Contracts\BrandoRepositoryInterface;
use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandRepositoryTest extends TestCase
{
    protected $brandRepository;

    protected function setUp(): void
    {
        $this->brandRepository = new BrandRepository(new Brand());

        parent::setUp();
    }

    /**
     * @test
     */
    public function implements_interface()
    {
        $this->assertInstanceOf(
                BrandRepositoryInterface::class,
                $this->brandRepository
        );
    }

    /**
     * @test
     */
    public function create_brand_exception()
    {
        $this->expectException(QueryException::class);

        $brand = [
            'nome' => 'LG',
        ];

        $this->brandRepository->createBrand($brand);
        
    }

     /** 
     * @test
     */
    public function create_brand()
    {

        $brand = [
            'name' => 'LG',
        ];

        $response = $this->brandRepository->createBrand($brand);

        $this->assertNotNull($response);

        $this->assertIsObject($response);

        $this->assertDatabaseHas('brands', [
            'name' => 'LG'
        ]);
    }

     /**
     * @test
     */
    public function find_all_brands_empty()
    {
        $response = $this->brandRepository->findAllBrands();

        $this->assertCount(0, $response);
    }

    /**
     * @test
     */

     public function find_all_brands()
     {
         Brand::factory()->count(10)->create();
 
         $response = $this->brandRepository->findAllBrands();
 
         $this->assertCount(10, $response);
     }

     /**
      * @test
      */
      public function find_brand_by_id()
      {
          $brand = Brand::factory()->create();
  
          $response = $this->brandRepository->findBrandById($brand->id);
  
          $this->assertIsObject($response);
      }

      /**
      * @test
      */
      public function update_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->brandRepository->findBrandById($brand->id);

        $this->assertNotNull($response);

        $this->assertIsObject($response);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
        ]);
    }
}
