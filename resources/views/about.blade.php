@extends('layouts.app')

@section('title', 'About Us - 120 Customs')
@section('description', 'Learn about 120 Customs - your premier destination for custom vehicle modifications, restorations, and bespoke automotive solutions. Over 15 years of experience in transforming vehicles.')

@section('content')
<!-- Page Header -->
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                About 120 Customs
            </h1>
            <p class="mt-4 text-xl text-gray-300 max-w-2xl mx-auto">
                Transforming vehicles into masterpieces for over 15 years
            </p>
        </div>
    </div>
</div>

<!-- Our Story -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Story
                </h2>
                <p class="mt-3 max-w-3xl text-lg text-gray-500">
                    Founded in 2008, 120 Customs began as a passion project in a small garage with a simple mission: to transform ordinary vehicles into extraordinary works of art. What started as weekend hobby projects has evolved into one of the region's most trusted custom automotive shops.
                </p>
                <div class="mt-8 space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Our Vision</h3>
                        <p class="mt-2 text-base text-gray-500">
                            To be the leading custom automotive shop that brings our clients' automotive dreams to life through exceptional craftsmanship, innovative design, and unparalleled customer service.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Our Mission</h3>
                        <p class="mt-2 text-base text-gray-500">
                            We combine traditional craftsmanship with modern technology to create unique, high-quality custom vehicles that exceed our clients' expectations while maintaining the highest standards of safety and reliability.
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-8 lg:mt-0">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-8 text-center">
                    <div class="flex items-center justify-center h-32 w-32 mx-auto mb-4 bg-blue-100 rounded-full">
                        <svg class="h-16 w-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">15+ Years</h3>
                    <p class="text-gray-300">of experience in custom automotive work</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Services -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Our Services</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                What We Do Best
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                From complete restorations to performance modifications, we offer comprehensive automotive customization services.
            </p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Service 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Custom Modifications</h3>
                    <p class="text-base text-gray-500">
                        Complete vehicle transformations including body kits, custom paint jobs, interior modifications, and unique styling elements tailored to your vision.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Vehicle Restoration</h3>
                    <p class="text-base text-gray-500">
                        Bring classic and vintage vehicles back to their former glory with our meticulous restoration services, preserving authenticity while enhancing performance.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Performance Tuning</h3>
                    <p class="text-base text-gray-500">
                        Maximize your vehicle's potential with professional engine tuning, suspension upgrades, and performance modifications for enhanced power and handling.
                    </p>
                </div>

                <!-- Service 4 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Paint & Bodywork</h3>
                    <p class="text-base text-gray-500">
                        Professional automotive painting and bodywork services, from collision repair to complete color changes and custom paint schemes.
                    </p>
                </div>

                <!-- Service 5 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Custom Fabrication</h3>
                    <p class="text-base text-gray-500">
                        Unique metal fabrication and welding services to create one-of-a-kind parts and modifications that can't be found anywhere else.
                    </p>
                </div>

                <!-- Service 6 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Audio & Electronics</h3>
                    <p class="text-base text-gray-500">
                        State-of-the-art audio system installations, custom electronics integration, and modern technology upgrades for classic vehicles.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Process -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Our Process</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                How We Work
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                From initial consultation to final delivery, we ensure every project meets the highest standards.
            </p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-4">
                        <span class="text-xl font-bold">1</span>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Consultation</h3>
                    <p class="text-base text-gray-500">
                        We discuss your vision, requirements, and budget to create a detailed project plan.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-4">
                        <span class="text-xl font-bold">2</span>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Design & Planning</h3>
                    <p class="text-base text-gray-500">
                        Our team creates detailed designs and sourcing plans for all parts and materials needed.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-4">
                        <span class="text-xl font-bold">3</span>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Expert Execution</h3>
                    <p class="text-base text-gray-500">
                        Our skilled craftsmen bring your vision to life with precision and attention to detail.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-4">
                        <span class="text-xl font-bold">4</span>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Quality Assurance</h3>
                    <p class="text-base text-gray-500">
                        Thorough testing and quality checks ensure your vehicle meets our high standards.
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
            <span class="block">Ready to start your project?</span>
            <span class="block text-blue-600">Let's discuss your vision.</span>
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
@endsection
