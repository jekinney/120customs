<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiclesBrandFactory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = config('vehicles.brands', []);

        $currentBrands = \App\Models\Vehicles\Brand::get();
        foreach ($brands as $brand) {
            if (!$currentBrands->contains('name', $brand['name'])) {
                \App\Models\Vehicles\Brand::create(['name' => $brand['name']]);
            }
        }
    }
}
