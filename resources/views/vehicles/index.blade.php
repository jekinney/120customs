@extends('layouts.app')

@section('title', 'Our Vehicles - 120 Customs')
@section('description', 'Explore our collection of custom vehicles, modifications, and restorations. See what 120 Customs can do for your vehicle.')

@section('content')
<!-- Page Header -->
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                Our Vehicle Collection
            </h1>
            <p class="mt-4 text-xl text-gray-300 max-w-2xl mx-auto">
                Browse through our portfolio of custom vehicles, modifications, and restorations that showcase our craftsmanship and attention to detail.
            </p>
        </div>
    </div>
</div>

<!-- Vehicles Grid -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($vehicles->count() > 0)
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($vehicles as $vehicle)
                    <div class="group cursor-pointer" onclick="window.location='{{ route('vehicle.show', $vehicle) }}'">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <!-- Vehicle Image -->
                            <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center group-hover:from-gray-300 group-hover:to-gray-400 transition-colors duration-300 overflow-hidden">
                                @php
                                    $featuredImage = $vehicle->galleries->where('is_featured', true)->first() ?: $vehicle->galleries->first();
                                @endphp
                                
                                @if($featuredImage)
                                    <img src="{{ Storage::url($featuredImage->image_path) }}" 
                                         alt="{{ $featuredImage->alt_text ?: $vehicle->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                @endif
                            </div>
                            
                            <!-- Vehicle Info -->
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                                    {{ $vehicle->name }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $vehicle->year }} {{ $vehicle->brand->name }} {{ $vehicle->model }} {{ $vehicle->type->name }}
                                </p>
                                @if($vehicle->description)
                                    <p class="text-gray-700 mt-3 text-sm line-clamp-3">
                                        {{ Str::limit($vehicle->description, 100) }}
                                    </p>
                                @endif
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $vehicle->brand->name }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $vehicle->type->name }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $vehicle->year }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $vehicles->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No vehicles yet</h3>
                <p class="mt-2 text-gray-500 max-w-sm mx-auto">
                    We're currently working on some amazing projects. Check back soon to see our latest custom vehicles and modifications.
                </p>
                <div class="mt-8 space-x-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Get In Touch
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Learn More
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Call to Action -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to transform your vehicle?</span>
                <span class="block text-blue-200">Let's discuss your vision.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                        Start Your Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
