<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Electrolux', 'Brastemp', 'Fischer', 'Samsung', 'LG'];

        foreach ($brands as $brandName) {
            Brand::create([
                'name' => $brandName,
                'uuid' =>Str::uuid(),
            ]);
        }
    }
}
