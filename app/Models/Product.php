<?php

namespace App\Models;

use App\Enums\ProductVoltageEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'voltage',
        'brand_id'
    ];
   
    protected $casts = [
        'voltage' => ProductVoltageEnum::class,
    ];

    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
