<?php

namespace Tests\Unit\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class BrandTest extends BaseModelTestCase
{
    
    protected function model(): Model
    {
        return new Brand();
    }

    protected function fillable(): array
    {
        return [
            'name',
        ];
    }
}
