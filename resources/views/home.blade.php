@extends('layouts.app')

@section('title', 'Home - 120 Customs')
@section('description', '120 Customs - Premier custom vehicle modifications, restorations, and bespoke automotive solutions. Transform your vehicle into something extraordinary.')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gray-900 overflow-hidden">
    @if($featuredVehicles->count() > 0)
        <!-- Vehicle Carousel -->
        <div id="hero-carousel" class="relative h-96 md:h-[500px] lg:h-[600px]">
            @foreach($featuredVehicles as $index => $vehicle)
                <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
                    <!-- Background with gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent z-10"></div>
                    
                    <!-- Vehicle Image Background -->
                    @php
                        $featuredImage = $vehicle->galleries->where('is_featured', true)->first() ?: $vehicle->galleries->first();
                    @endphp
                    
                    @if($featuredImage)
                        <div class="absolute inset-0">
                            <img src="{{ Storage::url($featuredImage->image_path) }}" 
                                 alt="{{ $featuredImage->alt_text ?: $vehicle->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @else
                        <!-- Fallback placeholder background when no images -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900">
                            <div class="flex items-center justify-center h-full">
                                <svg class="w-32 h-32 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Content -->
                    <div class="relative z-20 h-full flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="max-w-2xl">
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                                    {{ $vehicle->name }}
                                </h1>
                                <p class="text-xl md:text-2xl text-gray-300 mb-2">
                                    {{ $vehicle->year }} {{ $vehicle->brand->name }} {{ $vehicle->model }} {{ $vehicle->type->name }}
                                </p>
                                @if($vehicle->description)
                                    <p class="text-lg text-gray-400 mb-6 max-w-lg">
                                        {{ Str::limit($vehicle->description, 150) }}
                                    </p>
                                @endif
                                <div class="space-x-4">
                                    <a href="{{ route('vehicle.show', $vehicle) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                                        View Details
                                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:text-gray-900 transition-colors duration-200">
                                        View All Work
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <!-- Carousel Navigation -->
            @if($featuredVehicles->count() > 1)
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                    @foreach($featuredVehicles as $index => $vehicle)
                        <button onclick="showSlide({{ $index }})" class="carousel-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/50' }} transition-colors duration-200"></button>
                    @endforeach
                </div>
                
                <!-- Arrow Navigation -->
                <button onclick="previousSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors duration-200 z-30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors duration-200 z-30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @endif
        </div>
    @else
        <!-- Coming Soon Hero -->
        <div class="relative h-96 md:h-[500px] lg:h-[600px] bg-gradient-to-br from-gray-800 to-gray-900">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent"></div>
            <div class="relative z-10 h-full flex items-center justify-center">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                        Custom Vehicles
                        <span class="text-blue-400">Coming Soon</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto">
                        We're currently working on amazing custom vehicle projects. Check back soon to see our latest creations and transformations.
                    </p>
                    <div class="space-x-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                            Get In Touch
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:text-gray-900 transition-colors duration-200">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- About Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">About 120 Customs</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Transforming Vehicles Into Art
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                At 120 Customs, we specialize in bringing your automotive dreams to life. From classic restorations to modern modifications, we combine craftsmanship with innovation.
            </p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Service 1 -->
                <div class="text-center">
                    <div class="flex justify-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Custom Modifications</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Transform your vehicle with custom bodywork, performance upgrades, and unique styling that reflects your personality.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="text-center">
                    <div class="flex justify-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Vehicle Restoration</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Bring classic and vintage vehicles back to their former glory with our expert restoration services.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="text-center">
                    <div class="flex justify-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Performance Tuning</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Maximize your vehicle's potential with professional performance tuning and engine modifications.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                Trusted by Vehicle Enthusiasts
            </h2>
            <p class="mt-3 text-xl text-blue-200 sm:mt-4">
                Our commitment to quality and craftsmanship speaks for itself
            </p>
        </div>
        <dl class="mt-10 text-center sm:max-w-3xl sm:mx-auto sm:grid sm:grid-cols-3 sm:gap-8">
            <div class="flex flex-col">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-blue-200">
                    Years Experience
                </dt>
                <dd class="order-1 text-5xl font-extrabold text-white">
                    15+
                </dd>
            </div>
            <div class="flex flex-col mt-10 sm:mt-0">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-blue-200">
                    Projects Completed
                </dt>
                <dd class="order-1 text-5xl font-extrabold text-white">
                    500+
                </dd>
            </div>
            <div class="flex flex-col mt-10 sm:mt-0">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-blue-200">
                    Happy Customers
                </dt>
                <dd class="order-1 text-5xl font-extrabold text-white">
                    100%
                </dd>
            </div>
        </dl>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            <span class="block">Ready to customize your vehicle?</span>
            <span class="block text-blue-600">Get started with a consultation.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Get a Quote
                </a>
            </div>
            <div class="ml-3 inline-flex rounded-md shadow">
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                    View Our Work
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const totalSlides = {{ $featuredVehicles->count() }};
    
    function showSlide(index) {
        // Hide all slides
        document.querySelectorAll('.carousel-slide').forEach(slide => {
            slide.classList.remove('opacity-100');
            slide.classList.add('opacity-0');
        });
        
        // Show target slide
        const targetSlide = document.querySelector(`[data-slide="${index}"]`);
        if (targetSlide) {
            targetSlide.classList.remove('opacity-0');
            targetSlide.classList.add('opacity-100');
        }
        
        // Update dots
        document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-white');
            } else {
                dot.classList.remove('bg-white');
                dot.classList.add('bg-white/50');
            }
        });
        
        currentSlide = index;
    }
    
    function nextSlide() {
        const next = (currentSlide + 1) % totalSlides;
        showSlide(next);
    }
    
    function previousSlide() {
        const prev = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(prev);
    }
    
    // Auto-advance slides every 5 seconds
    @if($featuredVehicles->count() > 1)
        setInterval(nextSlide, 5000);
    @endif
</script>
@endsection
