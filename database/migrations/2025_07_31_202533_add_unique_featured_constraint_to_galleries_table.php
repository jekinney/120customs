<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, find all duplicate featured images and fix them
        $duplicates = DB::select("
            SELECT vehicle_id, COUNT(*) as count 
            FROM galleries 
            WHERE is_featured = 1 
            GROUP BY vehicle_id 
            HAVING COUNT(*) > 1
        ");
        
        foreach ($duplicates as $duplicate) {
            // Keep only the first featured image for each vehicle
            $firstFeatured = DB::select("
                SELECT id FROM galleries 
                WHERE vehicle_id = ? AND is_featured = 1 
                ORDER BY id ASC 
                LIMIT 1
            ", [$duplicate->vehicle_id]);
            
            if (!empty($firstFeatured)) {
                // Unfeatured all others
                DB::update("
                    UPDATE galleries 
                    SET is_featured = 0 
                    WHERE vehicle_id = ? AND is_featured = 1 AND id != ?
                ", [$duplicate->vehicle_id, $firstFeatured[0]->id]);
            }
        }
        
        // Ensure each vehicle has at least one featured image
        $vehiclesWithoutFeatured = DB::select("
            SELECT DISTINCT v.id as vehicle_id 
            FROM vehicles v 
            LEFT JOIN galleries g ON v.id = g.vehicle_id AND g.is_featured = 1 
            WHERE g.id IS NULL 
            AND EXISTS (SELECT 1 FROM galleries g2 WHERE g2.vehicle_id = v.id)
        ");
        
        foreach ($vehiclesWithoutFeatured as $vehicle) {
            // Make the first image featured
            DB::update("
                UPDATE galleries 
                SET is_featured = 1 
                WHERE vehicle_id = ? 
                ORDER BY id ASC 
                LIMIT 1
            ", [$vehicle->vehicle_id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            // No rollback needed as this just cleans up data
        });
    }
};
