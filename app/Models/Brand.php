<?php

namespace App\Models;

use App\Enums\BrandNameEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'brand' => BrandNameEnum::class,
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
