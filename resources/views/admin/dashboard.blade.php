@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Vehicles -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0a2 2 0 01-2-2V9a2 2 0 012-2h2V7"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Vehicles</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Vehicles\Vehicle::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('admin.vehicles.index') }}" class="font-medium text-cyan-700 hover:text-cyan-900">View all</a>
                </div>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Projects</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Vehicles\Vehicle::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('admin.vehicles.index') }}" class="font-medium text-cyan-700 hover:text-cyan-900">View all</a>
                </div>
            </div>
        </div>

        <!-- Total Images -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Gallery Images</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Vehicles\Gallery::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="text-blue-600 font-medium">{{ \App\Models\Vehicles\Gallery::where('is_featured', true)->count() }} featured</span>
                </div>
            </div>
        </div>

        <!-- Vehicle Brands -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Vehicle Brands</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Vehicles\Brand::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="text-purple-600 font-medium">{{ \App\Models\Vehicles\Type::count() }} vehicle types</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Vehicle Projects -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Vehicle Projects</h3>
            </div>
            <div class="p-6">
                @php
                    $recentVehicles = \App\Models\Vehicles\Vehicle::with(['brand', 'type'])->orderBy('created_at', 'desc')->limit(3)->get();
                @endphp
                
                @if($recentVehicles->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentVehicles as $vehicle)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0a2 2 0 01-2-2V9a2 2 0 012-2h2V7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $vehicle->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $vehicle->year }} {{ $vehicle->brand->name }} {{ $vehicle->model }} {{ $vehicle->type->name }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $vehicle->created_at->format('M j') }}</p>
                                <p class="text-xs text-green-600">
                                    {{ $vehicle->galleries->count() }} 
                                    {{ $vehicle->galleries->count() === 1 ? 'image' : 'images' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0a2 2 0 01-2-2V9a2 2 0 012-2h2V7"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No vehicle projects yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding your first vehicle project.</p>
                    </div>
                @endif
                
                <div class="mt-6">
                    <a href="{{ route('admin.vehicles.index') }}" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View all vehicles
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.vehicles.create') }}" class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-lg font-medium">Add Vehicle</h3>
                            <p class="mt-2 text-sm text-gray-500">Add a new vehicle project</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.vehicles.index') }}" class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-green-50 text-green-600 group-hover:bg-green-100">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0a2 2 0 01-2-2V9a2 2 0 012-2h2V7"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-lg font-medium">Manage Vehicles</h3>
                            <p class="mt-2 text-sm text-gray-500">View and edit vehicle projects</p>
                        </div>
                    </a>

                    <a href="{{ route('home') }}" target="_blank" class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-orange-50 text-orange-600 group-hover:bg-orange-100">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-lg font-medium">View Website</h3>
                            <p class="mt-2 text-sm text-gray-500">Preview the public website</p>
                        </div>
                    </a>

                    <a href="{{ route('vehicles.index') }}" target="_blank" class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-purple-50 text-purple-600 group-hover:bg-purple-100">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-lg font-medium">Vehicle Gallery</h3>
                            <p class="mt-2 text-sm text-gray-500">Browse public vehicle gallery</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Overview -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">120 Customs Overview</h3>
        </div>
        <div class="p-6">
            @php
                $vehiclesByBrand = \App\Models\Vehicles\Vehicle::with('brand')
                    ->get()
                    ->groupBy('brand.name')
                    ->map(function($vehicles) {
                        return $vehicles->count();
                    });
                
                $vehiclesByType = \App\Models\Vehicles\Vehicle::with('type')
                    ->get()
                    ->groupBy('type.name')
                    ->map(function($vehicles) {
                        return $vehicles->count();
                    });
            @endphp
            
            @if($vehiclesByBrand->count() > 0 || $vehiclesByType->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Vehicles by Brand -->
                    @if($vehiclesByBrand->count() > 0)
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Projects by Brand</h4>
                        <div class="space-y-3">
                            @foreach($vehiclesByBrand as $brandName => $count)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-700">{{ $brandName }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $count }} {{ $count === 1 ? 'project' : 'projects' }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Vehicles by Type -->
                    @if($vehiclesByType->count() > 0)
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Projects by Type</h4>
                        <div class="space-y-3">
                            @foreach($vehiclesByType as $typeName => $count)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-700">{{ $typeName }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $count }} {{ $count === 1 ? 'project' : 'projects' }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0a2 2 0 01-2-2V9a2 2 0 012-2h2V7"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No vehicle projects yet</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Start showcasing your custom vehicle work by adding your first project.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add your first vehicle
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any dashboard-specific JavaScript here
    console.log('Dashboard loaded');
</script>
@endpush
