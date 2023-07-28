<?php

namespace App\Observers;

use Illuminate\Support\Str;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    /**
     * Handle the Brand "created" event.
     */
    public function creating(Brand $brand): void
    {
        $brand->uuid = (string) Str::uuid();

        $cacheKey = "brand:all"; 
        $brands = Brand::all(); 

        Cache::rememberForever($cacheKey, function () use ($brands) {
            return $brands;
        });
    }

    /**
     * Handle the Brand "updated" event.
     */
    public function updated(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "deleted" event.
     */
    public function deleted(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "restored" event.
     */
    public function restored(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     */
    public function forceDeleted(Brand $brand): void
    {
        //
    }
}
