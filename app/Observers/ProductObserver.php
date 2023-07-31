<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function creating(Product $product): void
    {
        $product->uuid = (string) Str::uuid();

        $cacheKey = "product:all"; 
        $products = Product::all(); 

        Cache::rememberForever($cacheKey, function () use ($products) {
            return $products;
        });
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
