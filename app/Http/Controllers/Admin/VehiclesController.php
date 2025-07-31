<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\Brand;
use App\Models\Vehicles\Type;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::with(['brand', 'type'])->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        return view('admin.vehicles.create', compact('brands', 'types'));
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:4'],
            'description' => ['nullable', 'string'],
            'brand_id' => ['required', 'exists:brands,id'],
            'type_id' => ['required', 'exists:types,id'],
        ]);

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['brand', 'type', 'galleries']);
        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        $brands = Brand::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        return view('admin.vehicles.edit', compact('vehicle', 'brands', 'types'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:4'],
            'description' => ['nullable', 'string'],
            'brand_id' => ['required', 'exists:brands,id'],
            'type_id' => ['required', 'exists:types,id'],
        ]);

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
