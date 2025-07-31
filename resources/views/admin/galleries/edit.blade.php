@extends('layouts.admin')

@section('title', 'Edit Gallery Image')

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
                            <span class="ml-4 text-sm font-medium text-gray-500">Edit Image</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="mt-2 text-xl font-semibold text-gray-900">Edit Gallery Image</h1>
        </div>
    </div>

    <!-- Current Image -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Current Image</h3>
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <img src="{{ Storage::url($gallery->image_path) }}" 
                         alt="{{ $gallery->alt_text ?: $gallery->vehicle->name }}" 
                         class="h-32 w-auto rounded-lg shadow-sm border border-gray-200">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">{{ $gallery->vehicle->name }}</p>
                    @if($gallery->caption)
                        <p class="text-sm text-gray-500 mt-1">{{ $gallery->caption }}</p>
                    @endif
                    <div class="mt-2 flex items-center space-x-4">
                        @if($gallery->is_featured)
                            <span class="inline-block px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                Featured
                            </span>
                        @endif
                        <span class="text-xs text-gray-500">
                            Uploaded {{ $gallery->created_at->format('M j, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow sm:rounded-lg">
        <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')
            
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Vehicle Selection -->
                    <div class="sm:col-span-2">
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700">
                            Vehicle <span class="text-red-500">*</span>
                        </label>
                        <select name="vehicle_id" id="vehicle_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $gallery->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Replace Image (Optional) -->
                    <div class="sm:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            Replace Image (Optional)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a new file</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 5MB</p>
                                <p class="text-xs text-gray-500">Leave empty to keep current image</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Caption -->
                    <div class="sm:col-span-2">
                        <label for="caption" class="block text-sm font-medium text-gray-700">
                            Caption
                        </label>
                        <textarea name="caption" id="caption" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                  placeholder="Optional caption for this image">{{ old('caption', $gallery->caption) }}</textarea>
                        @error('caption')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alt Text -->
                    <div class="sm:col-span-2">
                        <label for="alt_text" class="block text-sm font-medium text-gray-700">
                            Alt Text
                        </label>
                        <input type="text" name="alt_text" id="alt_text" value="{{ old('alt_text', $gallery->alt_text) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="Descriptive text for accessibility">
                        <p class="mt-2 text-sm text-gray-500">
                            Describes the image for screen readers. If not provided, the vehicle name will be used.
                        </p>
                        @error('alt_text')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured -->
                    <div class="sm:col-span-2">
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_featured" name="is_featured" type="checkbox" value="1" 
                                       {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}
                                       class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_featured" class="font-medium text-gray-700">Featured Image</label>
                                <p class="text-gray-500">This image will be highlighted and may appear in special displays.</p>
                            </div>
                        </div>
                        @error('is_featured')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                    Update Image
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Image</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>Once you delete this image, it will be permanently removed from storage and cannot be recovered.</p>
            </div>
            <div class="mt-5">
                <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this image? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                        Delete Image
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Preview image on selection
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Create preview if it doesn't exist
            let preview = document.getElementById('image-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.id = 'image-preview';
                preview.className = 'mt-4';
                e.target.closest('.space-y-1').appendChild(preview);
            }
            
            preview.innerHTML = `
                <div class="relative inline-block">
                    <img src="${e.target.result}" class="h-32 w-auto rounded-lg shadow-sm border border-gray-200" alt="Preview">
                    <button type="button" onclick="clearPreview()" class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 rounded-full p-1 text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
});

function clearPreview() {
    document.getElementById('image').value = '';
    const preview = document.getElementById('image-preview');
    if (preview) {
        preview.remove();
    }
}
</script>
@endpush
@endsection
