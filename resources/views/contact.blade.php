@extends('layouts.app')

@section('title', 'Contact Us - 120 Customs')
@section('description', 'Get in touch with 120 Customs for your custom vehicle project. Contact us for quotes, consultations, and inquiries about our automotive services.')

@section('content')
<!-- Page Header -->
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                Contact Us
            </h1>
            <p class="mt-4 text-xl text-gray-300 max-w-2xl mx-auto">
                Ready to transform your vehicle? Get in touch with our team to discuss your project.
            </p>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <!-- Contact Information -->
            <div>
                <div class="max-w-xl">
                    <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                        Get In Touch
                    </h2>
                    <p class="mt-3 text-lg text-gray-500">
                        Have a project in mind? We'd love to hear about it. Contact us today to schedule a consultation and get a quote for your custom vehicle project.
                    </p>
                    
                    <div class="mt-9 space-y-6">
                        <!-- Phone -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-gray-900">Phone</p>
                                <p class="text-base text-gray-500">(555) 123-CUSTOM</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-gray-900">Email</p>
                                <p class="text-base text-gray-500">info@120customs.com</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-gray-900">Address</p>
                                <p class="text-base text-gray-500">
                                    120 Custom Drive<br>
                                    Automotive City, AC 12345
                                </p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-gray-900">Business Hours</p>
                                <div class="text-base text-gray-500">
                                    <p>Monday - Friday: 8:00 AM - 6:00 PM</p>
                                    <p>Saturday: 9:00 AM - 4:00 PM</p>
                                    <p>Sunday: Closed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-8">
                        <h3 class="text-base font-medium text-gray-900 mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.624 5.367 11.99 11.988 11.99s11.99-5.366 11.99-11.99C24.007 5.367 18.641.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.27c.928-.823 2.026-1.235 3.323-1.235 1.297 0 2.448.412 3.323 1.235.928.822 1.418 1.973 1.418 3.27s-.49 2.448-1.418 3.244c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.456h-1.094V6.435h1.094v1.097zm-1.414 5.667c0-.658-.263-1.244-.684-1.665-.42-.42-1.006-.684-1.665-.684-.658 0-1.244.263-1.665.684-.42.42-.684 1.006-.684 1.665 0 .658.263 1.244.684 1.665.42.42 1.006.684 1.665.684.658 0 1.244-.263 1.665-.684.42-.42.684-1.006.684-1.665z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">YouTube</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="mt-12 lg:mt-0">
                <div class="bg-gray-50 rounded-lg p-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Send us a message</h3>
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    First Name *
                                </label>
                                <input 
                                    type="text" 
                                    name="first_name" 
                                    id="first_name" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="John">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Last Name *
                                </label>
                                <input 
                                    type="text" 
                                    name="last_name" 
                                    id="last_name" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Doe">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="john@example.com">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                id="phone" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="(555) 123-4567">
                        </div>

                        <div>
                            <label for="project_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Project Type
                            </label>
                            <select 
                                name="project_type" 
                                id="project_type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Select a project type</option>
                                <option value="custom_modification">Custom Modification</option>
                                <option value="restoration">Vehicle Restoration</option>
                                <option value="performance_tuning">Performance Tuning</option>
                                <option value="paint_bodywork">Paint & Bodywork</option>
                                <option value="fabrication">Custom Fabrication</option>
                                <option value="audio_electronics">Audio & Electronics</option>
                                <option value="consultation">General Consultation</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="vehicle_info" class="block text-sm font-medium text-gray-700 mb-2">
                                Vehicle Information
                            </label>
                            <input 
                                type="text" 
                                name="vehicle_info" 
                                id="vehicle_info" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="e.g., 2020 Ford Mustang GT">
                        </div>

                        <div>
                            <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">
                                Estimated Budget
                            </label>
                            <select 
                                name="budget" 
                                id="budget" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Select budget range</option>
                                <option value="under_5k">Under $5,000</option>
                                <option value="5k_10k">$5,000 - $10,000</option>
                                <option value="10k_25k">$10,000 - $25,000</option>
                                <option value="25k_50k">$25,000 - $50,000</option>
                                <option value="50k_100k">$50,000 - $100,000</option>
                                <option value="over_100k">Over $100,000</option>
                                <option value="discuss">Prefer to discuss</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Project Details *
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="4" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Tell us about your project vision, timeline, and any specific requirements..."></textarea>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input 
                                    id="newsletter" 
                                    name="newsletter" 
                                    type="checkbox" 
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="newsletter" class="font-medium text-gray-700">
                                    Subscribe to our newsletter
                                </label>
                                <p class="text-gray-500">Get updates on our latest projects and automotive tips.</p>
                            </div>
                        </div>

                        <div>
                            <button 
                                type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section (Optional - can be replaced with actual map embed) -->
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900">Visit Our Shop</h2>
            <p class="mt-4 text-lg text-gray-500">
                Come see our facility and meet our team of automotive experts.
            </p>
        </div>
        
        <!-- Placeholder for map - replace with actual Google Maps embed or similar -->
        <div class="bg-gray-300 rounded-lg h-96 flex items-center justify-center">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <p class="text-gray-600 text-lg">Interactive Map Coming Soon</p>
                <p class="text-gray-500 mt-2">120 Custom Drive, Automotive City, AC 12345</p>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">FAQ</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Frequently Asked Questions
            </p>
        </div>

        <div class="mt-12 max-w-3xl mx-auto">
            <div class="space-y-8">
                <!-- FAQ 1 -->
                <div class="border-b border-gray-200 pb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">How long does a typical project take?</h3>
                    <p class="text-gray-500">
                        Project timelines vary greatly depending on the scope of work. Simple modifications can take 1-2 weeks, while complete restorations may take 6-12 months. We'll provide a detailed timeline during your consultation.
                    </p>
                </div>

                <!-- FAQ 2 -->
                <div class="border-b border-gray-200 pb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Do you provide warranties on your work?</h3>
                    <p class="text-gray-500">
                        Yes, we stand behind our craftsmanship with comprehensive warranties. Paint work is warrantied for 5 years, mechanical work for 2 years, and electrical installations for 1 year.
                    </p>
                </div>

                <!-- FAQ 3 -->
                <div class="border-b border-gray-200 pb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Can I see progress updates on my vehicle?</h3>
                    <p class="text-gray-500">
                        Absolutely! We provide regular photo updates and welcome scheduled visits to see your project's progress. We believe in complete transparency throughout the build process.
                    </p>
                </div>

                <!-- FAQ 4 -->
                <div class="border-b border-gray-200 pb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">What types of vehicles do you work on?</h3>
                    <p class="text-gray-500">
                        We work on all types of vehicles including classic cars, modern sports cars, trucks, motorcycles, and specialty vehicles. Our team has experience with both domestic and import vehicles.
                    </p>
                </div>

                <!-- FAQ 5 -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">How do you determine project pricing?</h3>
                    <p class="text-gray-500">
                        Pricing is based on several factors including labor time, parts costs, complexity of work, and materials used. We provide detailed written estimates before any work begins, with no hidden fees.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to get started?</span>
                <span class="block text-blue-200">Schedule your consultation today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="tel:+15551232878" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                        Call Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
