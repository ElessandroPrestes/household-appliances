<?php

namespace Tests\Feature\Repositories;

use App\Models\Brand;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    protected $productRepository;

    protected function setUp(): void
    {
        $this->productRepository = new ProductRepository(new Product());

        parent::setUp();
    }

    /**
     * @test
     */
    public function implements_interface_product()
    {
        $this->assertInstanceOf(
                ProductRepositoryInterface::class,
                $this->productRepository
        );
    }

    /**
     * @test
     */
    public function create_product_by_brand_exception()
    {
        $this->expectException(QueryException::class);

        $brandId = 1;
        $product = [
            'description' => 'frost free',
        ];

        $this->productRepository->createProduct($brandId, $product);
        
    }

    /** 
     * @test
     */
    public function create_product_by_brand()
    {
        $brand = Brand::factory()->create();

        $product = [
            'name' => 'Geladeira',
            'description' => 'frost free',
            'voltage' => '110v',
        ];

        $response = $this->productRepository->createProduct($brand->id, $product);

        $this->assertNotNull($response);

        $this->assertInstanceOf(Product::class, $response);

        $this->assertIsObject($response);

        $this->assertDatabaseHas('products', [
            'name' => 'Geladeira'
        ]);
    }

     /** 
     * @test
     */
    public function findProductByBrand()
    {
        $brand = Brand::factory()->create();
        
        $products = Product::factory()->count(3)->create(['brand_id' => $brand->id]);

        $foundProducts = $this->productRepository->findProductByBrand($brand->id);

        $this->assertCount(3, $foundProducts);
        foreach ($foundProducts as $foundProduct) {
            $this->assertEquals($brand->id, $foundProduct->brand_id);
        }
    }
}
