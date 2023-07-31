<?php

namespace Tests\Feature\Repositories;

use App\Models\Brand;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function findAll_product_by_brand()
    {
        $brand = Brand::factory()->create();
        
        $products = Product::factory()->count(3)->create(['brand_id' => $brand->id]);

        $foundProducts = $this->productRepository->findAllProductByBrand($brand->id);

        $this->assertCount(3, $foundProducts);
        foreach ($foundProducts as $foundProduct) {
            $this->assertEquals($brand->id, $foundProduct->brand_id);
        }
    }

     /** 
     * @test
     */
    public function find_product_by_brand()
    {
        $brand = Brand::factory()->create();

        $product = Product::factory()->create([
            'brand_id' => $brand->id,
            'uuid' => 'example_uuid',
        ]);

        $this->expectException(NotFoundHttpException::class);

        $this->expectExceptionMessage('Brand By Product Not Found'); 

        $foundProduct = $this->productRepository->findProductByBrand($brand->id, 'example_uuid');

        $this->assertEquals($product->id, $foundProduct->id);

        $this->assertEquals($product->brand_id, $foundProduct->brand_id);
        
        $this->assertEquals($product->uuid, $foundProduct->uuid);

    }

    /** 
     * @test
     */
    public function find_product_by_brand_not_found()
    {
        $brandId = 1;

        $brand = Brand::factory()->create(['id' => $brandId]);

        $this->expectException(NotFoundHttpException::class);

        $this->expectExceptionMessage('Brand By Product Not Found'); 

        $this->productRepository->findProductByBrand($brand->id, 'non_existent_uuid');
    }

    /** 
     * @test
     */
    public function updateProductByBrand()
    {
    
        
        $brandId = 123; 

        $uuid = 'fake_uuid'; 

        $data = [
            'name' => 'Novo nome do produto',
            'brand_id' => 123,
            
        ];

        $productMock = $this->createMock(Product::class);

        $productMock->expects($this->once())->method('update')->with($data)->willReturn(true);

        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findProductByUuid'])
            ->getMock();

        $productRepository->expects($this->once())->method('findProductByUuid')->with($uuid)->willReturn($productMock);

        Cache::shouldReceive('forget')->once()->with('product:all');

        $result = $productRepository->updateProductByBrand($brandId, $uuid, $data);

        $this->assertTrue($result); // Verifica se o resultado da atualização é verdadeiro (se a atualização ocorreu com sucesso)
    }

    /**
     * @test
     */

     public function deleteProductByBrand()
     {
        
        $uuid = 'fake_uuid'; // Substitua por um UUID válido do seu banco de dados

        $productMock = $this->createMock(Product::class);

        $productMock->expects($this->once())->method('delete')->willReturn(true);
        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findProductByUuid'])
            ->getMock();

        $productRepository->expects($this->once())->method('findProductByUuid')->with($uuid)->willReturn($productMock);

        Cache::shouldReceive('forget')->once()->with('product:all');

        $result = $productRepository->deleteProductByBrand($uuid);

        $this->assertTrue($result); 
    }

    /**
     * @test
     */
    public function delete_product_by_brand_not_found()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->productRepository->deleteProductByBrand('fake_uuid');

    }

          
}
