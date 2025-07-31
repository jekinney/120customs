@extends('layouts.admin')

@section('title', 'View Vehicle')
@section('page-title', 'Vehicle Details')

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
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Vehicle Details</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                View vehicle information and specifications.
            </p>
        </div>
        <div class="mt-3 sm:mt-0 sm:ml-4 flex space-x-3">
            <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit Vehicle
            </a>
            <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Vehicles
            </a>
        </div>
    </div>

    <!-- Vehicle Details Card -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $vehicle->name }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $vehicle->year }} {{ $vehicle->brand->name }} {{ $vehicle->model }} {{ $vehicle->type->name }}
                    </p>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Vehicle name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Model
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->model }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Year
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->year }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Brand
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->brand->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Type
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->type->name }}
                        @if($vehicle->type->description)
                            <p class="text-gray-500 text-sm">{{ $vehicle->type->description }}</p>
                        @endif
                    </dd>
                </div>
                @if($vehicle->description)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Description
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->description }}
                    </dd>
                </div>
                @endif
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Created
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->created_at->format('F j, Y \a\t g:i A') }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Last updated
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $vehicle->updated_at->format('F j, Y \a\t g:i A') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Gallery Images
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage images for this vehicle. You can upload multiple images at once.
                    </p>
                </div>
                <button onclick="toggleUploadForm()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Images
                </button>
            </div>

            <!-- Upload Form -->
            <div id="upload-form" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                <form id="gallery-upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Select Images
                        </label>
                        
                        <!-- Upload Area -->
                        <div id="vehicle-upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors cursor-pointer">
                            <input type="file" id="vehicle-gallery-images" multiple accept="image/*" class="hidden" required>
                            <div id="vehicle-upload-prompt">
                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-base font-medium text-gray-900 mb-1">Drop images here or click to browse</p>
                                <p class="text-sm text-gray-500">PNG, JPG, GIF, WEBP up to 2MB each</p>
                            </div>
                        </div>
                        
                        <!-- Image Previews -->
                        <div id="vehicle-image-previews" class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-4 lg:grid-cols-6 hidden"></div>
                        
                        <!-- Featured Image Selection -->
                        <div id="vehicle-featured-selection" class="mt-4 hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Select Featured Image
                            </label>
                            <div id="vehicle-featured-options" class="space-y-2 max-h-32 overflow-y-auto"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="toggleUploadForm()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Upload Images
                        </button>
                    </div>
                </form>
            </div>

            <!-- Gallery Grid -->
            <div id="gallery-grid">
                @if($vehicle->galleries->count() > 0)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach($vehicle->galleries as $gallery)
                            <div class="relative group bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="aspect-w-16 aspect-h-12 rounded-t-lg overflow-hidden bg-gray-200">
                                    <img src="{{ Storage::url($gallery->image_path) }}" 
                                         alt="{{ $gallery->alt_text ?: $vehicle->name }}" 
                                         class="w-full h-48 object-cover">
                                </div>
                                <div class="p-4">
                                    @if($gallery->caption)
                                        <p class="text-sm text-gray-900 mb-2">{{ $gallery->caption }}</p>
                                    @endif
                                    @if($gallery->is_featured)
                                        <span class="inline-block px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full mb-2">
                                            Featured
                                        </span>
                                    @endif
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500">
                                            {{ $gallery->created_at->format('M j, Y') }}
                                        </span>
                                        <div class="flex space-x-2">
                                            @if(!$gallery->is_featured)
                                                <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="vehicle_id" value="{{ $gallery->vehicle_id }}">
                                                    <input type="hidden" name="caption" value="{{ $gallery->caption }}">
                                                    <input type="hidden" name="alt_text" value="{{ $gallery->alt_text }}">
                                                    <input type="hidden" name="is_featured" value="1">
                                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 text-xs font-medium">
                                                        Make Featured
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                                               class="text-blue-600 hover:text-blue-900 text-xs font-medium">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" 
                                                  onsubmit="return confirm('Are you sure you want to delete this image?{{ $gallery->is_featured ? ' This will make another image featured automatically.' : '' }}');" 
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-xs font-medium">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No images</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by uploading your first image.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Actions
            </h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>
                    Manage this vehicle or remove it from the system.
                </p>
            </div>
            <div class="mt-5 flex space-x-3">
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                    Edit Vehicle
                </a>
                <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Are you sure you want to delete this vehicle? This action cannot be undone.');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                        Delete Vehicle
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let vehicleUploadFiles = [];

// Upload functionality
function toggleUploadForm() {
    const form = document.getElementById('upload-form');
    form.classList.toggle('hidden');
    
    // Reset form when hiding
    if (form.classList.contains('hidden')) {
        resetVehicleUploadArea();
    }
}

// Vehicle upload area elements
const vehicleUploadArea = document.getElementById('vehicle-upload-area');
const vehicleFileInput = document.getElementById('vehicle-gallery-images');
const vehicleImagePreviewsContainer = document.getElementById('vehicle-image-previews');
const vehicleFeaturedSelection = document.getElementById('vehicle-featured-selection');
const vehicleFeaturedOptions = document.getElementById('vehicle-featured-options');
const vehicleUploadPrompt = document.getElementById('vehicle-upload-prompt');

// Drag and drop functionality
vehicleUploadArea.addEventListener('click', () => vehicleFileInput.click());

vehicleUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    vehicleUploadArea.classList.add('border-blue-500', 'bg-blue-50');
});

vehicleUploadArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    vehicleUploadArea.classList.remove('border-blue-500', 'bg-blue-50');
});

vehicleUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    vehicleUploadArea.classList.remove('border-blue-500', 'bg-blue-50');
    
    const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
    if (files.length > 0) {
        handleVehicleFiles(files);
    }
});

// File input change handler
vehicleFileInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    if (files.length > 0) {
        handleVehicleFiles(files);
    }
});

function handleVehicleFiles(files) {
    // Filter out files that are too large (5MB = 5242880 bytes)
    const maxFileSize = 5242880; // 5MB in bytes
    const validFiles = [];
    const invalidFiles = [];
    
    files.forEach(file => {
        if (file.size <= maxFileSize) {
            validFiles.push(file);
        } else {
            invalidFiles.push(file.name);
        }
    });
    
    if (invalidFiles.length > 0) {
        alert(`The following files are too large (max 5MB each, will be optimized to ~2MB during upload):\n${invalidFiles.join('\n')}`);
    }
    
    if (validFiles.length === 0) {
        return;
    }
    
    vehicleUploadFiles = validFiles;
    displayVehiclePreviews();
    createVehicleFeaturedOptions();
    showVehiclePreviewSection();
}

function displayVehiclePreviews() {
    vehicleImagePreviewsContainer.innerHTML = '';
    
    vehicleUploadFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const previewDiv = document.createElement('div');
            previewDiv.className = 'relative group';
            previewDiv.innerHTML = `
                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-200">
                    <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-20 object-cover">
                </div>
                <button type="button" onclick="removeVehicleFile(${index})" class="absolute -top-1 -right-1 bg-red-500 hover:bg-red-600 rounded-full p-1 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            vehicleImagePreviewsContainer.appendChild(previewDiv);
        };
        reader.readAsDataURL(file);
    });
}

function createVehicleFeaturedOptions() {
    vehicleFeaturedOptions.innerHTML = '';
    
    vehicleUploadFiles.forEach((file, index) => {
        const optionDiv = document.createElement('div');
        optionDiv.className = 'flex items-center';
        optionDiv.innerHTML = `
            <input id="vehicle_featured_${index}" name="vehicle_featured_index" type="radio" value="${index}" 
                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" 
                   ${index === 0 ? 'checked' : ''}>
            <label for="vehicle_featured_${index}" class="ml-3 block text-sm text-gray-700 truncate">
                ${file.name} ${index === 0 ? '(Default)' : ''}
            </label>
        `;
        vehicleFeaturedOptions.appendChild(optionDiv);
    });
}

function showVehiclePreviewSection() {
    vehicleUploadPrompt.classList.add('hidden');
    vehicleImagePreviewsContainer.classList.remove('hidden');
    vehicleImagePreviewsContainer.classList.add('grid');
    vehicleFeaturedSelection.classList.remove('hidden');
    
    // Update upload area appearance
    vehicleUploadArea.classList.add('border-green-300', 'bg-green-50');
    vehicleUploadArea.innerHTML = `
        <div class="text-center py-3">
            <svg class="mx-auto h-6 w-6 text-green-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-sm font-medium text-green-900">${vehicleUploadFiles.length} files selected</p>
            <p class="text-xs text-green-700">Click to select different files</p>
        </div>
    `;
}

function removeVehicleFile(index) {
    vehicleUploadFiles.splice(index, 1);
    
    if (vehicleUploadFiles.length === 0) {
        resetVehicleUploadArea();
    } else {
        // Update file input
        const dt = new DataTransfer();
        vehicleUploadFiles.forEach(file => dt.items.add(file));
        vehicleFileInput.files = dt.files;
        
        displayVehiclePreviews();
        createVehicleFeaturedOptions();
    }
}

function resetVehicleUploadArea() {
    vehicleUploadFiles = [];
    vehicleFileInput.value = '';
    vehicleImagePreviewsContainer.innerHTML = '';
    vehicleFeaturedOptions.innerHTML = '';
    vehicleImagePreviewsContainer.classList.add('hidden');
    vehicleImagePreviewsContainer.classList.remove('grid');
    vehicleFeaturedSelection.classList.add('hidden');
    vehicleUploadPrompt.classList.remove('hidden');
    vehicleUploadArea.classList.remove('border-green-300', 'bg-green-50');
    vehicleUploadArea.innerHTML = `
        <div id="vehicle-upload-prompt">
            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p class="text-base font-medium text-gray-900 mb-1">Drop images here or click to browse</p>
            <p class="text-sm text-gray-500">PNG, JPG, GIF, WEBP up to 5MB each</p>
        </div>
    `;
}

// Form submission handler
document.getElementById('gallery-upload-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (vehicleUploadFiles.length === 0) {
        alert('Please select at least one image.');
        return;
    }
    
    const formData = new FormData();
    
    // Add CSRF token
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    
    // Add vehicle ID 
    formData.append('vehicle_id', {{ $vehicle->id }});
    
    // Add all selected images
    vehicleUploadFiles.forEach((file, index) => {
        formData.append('images[]', file);
    });
    
    // Add featured index
    const featuredIndex = document.querySelector('input[name="vehicle_featured_index"]:checked')?.value || '0';
    formData.append('featured_index', featuredIndex);
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Uploading...';
    submitBtn.disabled = true;
    
    fetch('{{ route("admin.galleries.upload", $vehicle) }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`HTTP ${response.status}: ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Reload the page to show new images
            window.location.reload();
        } else {
            alert(data.message || 'An error occurred while uploading images.');
            console.error('Upload error:', data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Upload error: ' + error.message);
    })
    .finally(() => {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    });
});
</script>
@endpush
