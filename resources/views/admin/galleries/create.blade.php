@extends('layouts.admin')

@section('title', 'Add Gallery Image')

@push('styles')
<style>
.aspect-w-1 {
    position: relative;
    width: 100%;
}
.aspect-w-1::before {
    content: '';
    display: block;
    padding-bottom: 100%;
}
.aspect-h-1 > * {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('admin.galleries.index') }}" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Gallery</span>
                                Gallery
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <span class="ml-4 text-sm font-medium text-gray-500">Add Image</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="mt-2 text-xl font-semibold text-gray-900">Add Gallery Image</h1>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow sm:rounded-lg">
        <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Vehicle Selection -->
                    <div class="sm:col-span-2">
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700">
                            Vehicle <span class="text-red-500">*</span>
                        </label>
                        <select name="vehicle_id" id="vehicle_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('vehicle_id') border-red-300 @enderror">
                            <option value="">Select a vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Multiple Image Upload -->
                    <div class="sm:col-span-2">
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                            Images <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- Upload Area -->
                        <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors cursor-pointer">
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden" required>
                            <div id="upload-prompt">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-lg font-medium text-gray-900 mb-2">Drop images here or click to browse</p>
                                <p class="text-sm text-gray-500">PNG, JPG, GIF, WEBP up to 5MB each</p>
                                <p class="text-sm text-gray-500 mt-1">Select multiple files to upload at once</p>
                            </div>
                        </div>
                        
                        @error('images')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Image Previews -->
                        <div id="image-previews" class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 hidden"></div>
                        
                        <!-- Featured Image Selection -->
                        <div id="featured-selection" class="mt-4 hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Select Featured Image
                            </label>
                            <p class="text-sm text-gray-500 mb-3">Choose which image should be the featured image for this vehicle.</p>
                            <div id="featured-options" class="space-y-2"></div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="sm:col-span-2">
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Upload Tips</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>You can upload multiple images at once (up to 5MB each)</li>
                                            <li>Images larger than 2MB will be automatically optimized</li>
                                            <li>Select one image as the featured image</li>
                                            <li>You can add captions and edit details after upload</li>
                                            <li>If only one image is uploaded, it will automatically be featured</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-3">
                <a href="{{ route('admin.galleries.index') }}" 
                   class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Add Image
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let selectedFiles = [];

// Upload area elements
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('images');
const imagePreviewsContainer = document.getElementById('image-previews');
const featuredSelection = document.getElementById('featured-selection');
const featuredOptions = document.getElementById('featured-options');
const uploadPrompt = document.getElementById('upload-prompt');

// Drag and drop functionality
uploadArea.addEventListener('click', () => fileInput.click());

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('border-blue-500', 'bg-blue-50');
});

uploadArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
    
    const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
    if (files.length > 0) {
        handleFiles(files);
    }
});

// File input change handler
fileInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    if (files.length > 0) {
        handleFiles(files);
    }
});

function handleFiles(files) {
    selectedFiles = files;
    displayPreviews();
    createFeaturedOptions();
    showPreviewSection();
}

function displayPreviews() {
    imagePreviewsContainer.innerHTML = '';
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const previewDiv = document.createElement('div');
            previewDiv.className = 'relative group';
            previewDiv.innerHTML = `
                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-200">
                    <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-32 object-cover">
                </div>
                <button type="button" onclick="removeFile(${index})" class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 rounded-full p-1 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="mt-2">
                    <p class="text-xs text-gray-600 truncate">${file.name}</p>
                    <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(1)} MB</p>
                </div>
            `;
            imagePreviewsContainer.appendChild(previewDiv);
        };
        reader.readAsDataURL(file);
    });
}

function createFeaturedOptions() {
    featuredOptions.innerHTML = '';
    
    selectedFiles.forEach((file, index) => {
        const optionDiv = document.createElement('div');
        optionDiv.className = 'flex items-center';
        optionDiv.innerHTML = `
            <input id="featured_${index}" name="featured_index" type="radio" value="${index}" 
                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" 
                   ${index === 0 ? 'checked' : ''}>
            <label for="featured_${index}" class="ml-3 block text-sm font-medium text-gray-700">
                ${file.name} ${index === 0 ? '(Default)' : ''}
            </label>
        `;
        featuredOptions.appendChild(optionDiv);
    });
}

function showPreviewSection() {
    uploadPrompt.classList.add('hidden');
    imagePreviewsContainer.classList.remove('hidden');
    imagePreviewsContainer.classList.add('grid');
    featuredSelection.classList.remove('hidden');
    
    // Update upload area appearance
    uploadArea.classList.add('border-green-300', 'bg-green-50');
    uploadArea.innerHTML = `
        <div class="text-center py-4">
            <svg class="mx-auto h-8 w-8 text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-sm font-medium text-green-900">${selectedFiles.length} files selected</p>
            <p class="text-xs text-green-700">Click to select different files</p>
        </div>
    `;
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    
    if (selectedFiles.length === 0) {
        resetUploadArea();
    } else {
        // Update file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
        
        displayPreviews();
        createFeaturedOptions();
    }
}

function resetUploadArea() {
    selectedFiles = [];
    fileInput.value = '';
    imagePreviewsContainer.innerHTML = '';
    featuredOptions.innerHTML = '';
    imagePreviewsContainer.classList.add('hidden');
    imagePreviewsContainer.classList.remove('grid');
    featuredSelection.classList.add('hidden');
    uploadPrompt.classList.remove('hidden');
    uploadArea.classList.remove('border-green-300', 'bg-green-50');
    uploadArea.innerHTML = `
        <div id="upload-prompt">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p class="text-lg font-medium text-gray-900 mb-2">Drop images here or click to browse</p>
            <p class="text-sm text-gray-500">PNG, JPG, GIF, WEBP up to 5MB each</p>
            <p class="text-sm text-gray-500 mt-1">Select multiple files to upload at once</p>
        </div>
    `;
}

// Form submission handler
document.querySelector('form').addEventListener('submit', function(e) {
    if (selectedFiles.length === 0) {
        e.preventDefault();
        alert('Please select at least one image to upload.');
        return;
    }
    
    // Update file input with selected files
    const dt = new DataTransfer();
    selectedFiles.forEach(file => dt.items.add(file));
    fileInput.files = dt.files;
    
    // Add featured index to form
    const featuredIndex = document.querySelector('input[name="featured_index"]:checked')?.value || '0';
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'featured_index';
    hiddenInput.value = featuredIndex;
    this.appendChild(hiddenInput);
});
</script>
@endpush
@endsection
