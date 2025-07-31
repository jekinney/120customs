<?php

namespace App\Http\Controllers;

use App\Models\Vehicles\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of vehicles for public view.
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::with(['brand', 'type', 'galleries'])
            ->latest()
            ->paginate(12);

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Display the specified vehicle for public view.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['brand', 'type', 'galleries']);
        
        // Get related vehicles (same brand or type)
        $relatedVehicles = Vehicle::with(['brand', 'type', 'galleries'])
            ->where('id', '!=', $vehicle->id)
            ->where(function($query) use ($vehicle) {
                $query->where('brand_id', $vehicle->brand_id)
                      ->orWhere('type_id', $vehicle->type_id);
            })
            ->latest()
            ->take(3)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }
}
