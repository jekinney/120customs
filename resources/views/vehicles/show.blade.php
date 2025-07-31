@extends('layouts.app')

@section('title', $vehicle->name . ' - 120 Customs')
@section('description', $vehicle->description ? Str::limit($vehicle->description, 160) : $vehicle->year . ' ' . $vehicle->brand->name . ' ' . $vehicle->type->name . ' custom vehicle by 120 Customs.')

@section('content')
<!-- Vehicle Hero -->
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-white">
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('vehicles.index') }}" class="ml-1 text-gray-400 hover:text-white md:ml-2">
                            Vehicles
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-white md:ml-2">{{ $vehicle->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <!-- Vehicle Images -->
            <div class="mb-8 lg:mb-0">
                @if($vehicle->galleries->count() > 0)
                    @php
                        $featuredImage = $vehicle->galleries->where('is_featured', true)->first() ?: $vehicle->galleries->first();
                        $otherImages = $vehicle->galleries->where('id', '!=', $featuredImage->id);
                    @endphp
                    
                    <!-- Main Featured Image -->
                    <div class="mb-4">
                        <div class="aspect-w-16 aspect-h-12 rounded-lg overflow-hidden bg-gray-100">
                            <img src="{{ Storage::url($featuredImage->image_path) }}" 
                                 alt="{{ $featuredImage->alt_text ?: $vehicle->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    @if($otherImages->count() > 0)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($otherImages->take(4) as $image)
                                <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden bg-gray-100 cursor-pointer hover:opacity-75 transition-opacity"
                                     onclick="showMainImage('{{ Storage::url($image->image_path) }}', '{{ $image->alt_text ?: $vehicle->name }}')">
                                    <img src="{{ Storage::url($image->image_path) }}" 
                                         alt="{{ $image->alt_text ?: $vehicle->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <!-- Placeholder when no images -->
                    <div class="aspect-w-16 aspect-h-12 rounded-lg overflow-hidden bg-gradient-to-br from-gray-700 to-gray-800">
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-24 h-24 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Vehicle Details -->
            <div class="flex flex-col justify-center">
                <div>
                    <h1 class="text-3xl font-extrabold text-white sm:text-4xl">
                        {{ $vehicle->name }}
                    </h1>
                    <p class="mt-3 text-xl text-gray-300">
                        {{ $vehicle->year }} {{ $vehicle->brand->name }} {{ $vehicle->model }} {{ $vehicle->type->name }}
                    </p>
                    @if($vehicle->description)
                        <p class="mt-6 text-lg text-gray-400">
                            {{ $vehicle->description }}
                        </p>
                    @endif
                    
                    <div class="mt-8 flex flex-wrap gap-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $vehicle->brand->name }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            {{ $vehicle->model }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ $vehicle->type->name }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{ $vehicle->year }}
                        </span>
                    </div>

                    <div class="mt-10 flex space-x-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Get Similar Work
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:text-gray-900">
                            View All Vehicles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vehicle Specifications -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Vehicle Details</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Specifications & Information
            </p>
        </div>

        <div class="mt-10">
            <div class="bg-gray-50 shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">Vehicle Name</div>
                            <div class="text-sm text-gray-500">{{ $vehicle->name }}</div>
                        </div>
                    </li>
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">Year</div>
                            <div class="text-sm text-gray-500">{{ $vehicle->year }}</div>
                        </div>
                    </li>
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">Brand</div>
                            <div class="text-sm text-gray-500">{{ $vehicle->brand->name }}</div>
                        </div>
                    </li>
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">Model</div>
                            <div class="text-sm text-gray-500">{{ $vehicle->model }}</div>
                        </div>
                    </li>
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">Type</div>
                            <div class="text-sm text-gray-500">{{ $vehicle->type->name }}</div>
                        </div>
                    </li>
                    @if($vehicle->description)
                    <li class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900 mb-2">Description</div>
                        <div class="text-sm text-gray-500">{{ $vehicle->description }}</div>
                    </li>
                    @endif
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">Completed</div>
                            <div class="text-sm text-gray-500">{{ $vehicle->created_at->format('F Y') }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Related Vehicles -->
@if($relatedVehicles->count() > 0)
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">More Projects</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Related Vehicles
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                Check out other vehicles we've worked on with similar brands or types.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($relatedVehicles as $relatedVehicle)
                <div class="group cursor-pointer" onclick="window.location='{{ route('vehicle.show', $relatedVehicle) }}'">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Vehicle Image -->
                        <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center group-hover:from-gray-300 group-hover:to-gray-400 transition-colors duration-300 overflow-hidden">
                            @php
                                $featuredImage = $relatedVehicle->galleries->where('is_featured', true)->first() ?: $relatedVehicle->galleries->first();
                            @endphp
                            
                            @if($featuredImage)
                                <img src="{{ Storage::url($featuredImage->image_path) }}" 
                                     alt="{{ $featuredImage->alt_text ?: $relatedVehicle->name }}"
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
                                {{ $relatedVehicle->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $relatedVehicle->year }} {{ $relatedVehicle->brand->name }} {{ $relatedVehicle->model }} {{ $relatedVehicle->type->name }}
                            </p>
                            @if($relatedVehicle->description)
                                <p class="text-gray-700 mt-3 text-sm line-clamp-2">
                                    {{ Str::limit($relatedVehicle->description, 80) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                View All Vehicles
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif

<!-- Call to Action -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Inspired by this project?</span>
                <span class="block text-blue-200">Let's create something amazing for you.</span>
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

@push('scripts')
<script>
function showMainImage(imageSrc, altText) {
    const mainImageContainer = document.querySelector('.aspect-w-16.aspect-h-12 img');
    if (mainImageContainer) {
        mainImageContainer.src = imageSrc;
        mainImageContainer.alt = altText;
    }
}
</script>
@endpush
