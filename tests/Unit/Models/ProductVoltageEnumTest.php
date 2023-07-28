<?php

namespace Tests\Unit\Models;

use App\Enums\ProductVoltageEnum;
use PHPUnit\Framework\TestCase;

class ProductVoltageEnumTest extends TestCase
{
    /**
     * @test
     */

     public function it_has_voltage_110v()
    {
        $this->assertEquals('110v', ProductVoltageEnum::VOLTAGE_110v->value);
    }

    /** @test */
    public function it_has_voltage_220v()
    {
        $this->assertEquals('220v', ProductVoltageEnum::VOLTAGE_220v->value);
    }
}
