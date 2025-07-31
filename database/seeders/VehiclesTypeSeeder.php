<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiclesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = config('vehicles.types', []);

        $currentTypes = \App\Models\Vehicles\Type::get();

        foreach ($types as $type) {
            if (!$currentTypes->contains('name', $type['name'])) {
                \App\Models\Vehicles\Type::create(['name' => $type['name']]);
            }
        }
    }
}
