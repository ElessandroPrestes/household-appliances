<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class ProductTest extends BaseModelTestCase
{
    protected function model(): Model
    {
        return new Product();
    }

    protected function fillable(): array
    {
        return [
            'name',
            'description',
            'voltage',
            'brand_id'
        ];
    }
}
