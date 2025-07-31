@extends('layouts.admin')

@section('title', 'Gallery Images')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Gallery Images</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all gallery images uploaded to the system.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.galleries.create') }}" 
               class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                Add Image
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="GET" action="{{ route('admin.galleries.index') }}" class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                <div class="flex-1">
                    <label for="vehicle" class="block text-sm font-medium text-gray-700">Vehicle</label>
                    <select name="vehicle" id="vehicle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">All Vehicles</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ request('vehicle') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="featured" class="block text-sm font-medium text-gray-700">Featured</label>
                    <select name="featured" id="featured" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">All Images</option>
                        <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured Only</option>
                        <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Non-Featured Only</option>
                    </select>
                </div>
                <div class="flex-shrink-0">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Filter
                    </button>
                    @if(request()->hasAny(['vehicle', 'featured']))
                        <a href="{{ route('admin.galleries.index') }}" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galleries->count() > 0)
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-6">
                @foreach($galleries as $gallery)
                    <div class="relative group bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="aspect-w-16 aspect-h-12 rounded-t-lg overflow-hidden bg-gray-200">
                            <img src="{{ Storage::url($gallery->image_path) }}" 
                                 alt="{{ $gallery->alt_text ?: $gallery->vehicle->name }}" 
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <a href="{{ route('admin.vehicles.show', $gallery->vehicle) }}" 
                                   class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    {{ $gallery->vehicle->name }}
                                </a>
                                @if($gallery->is_featured)
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                        Featured
                                    </span>
                                @endif
                            </div>
                            @if($gallery->caption)
                                <p class="text-sm text-gray-900 mb-2">{{ $gallery->caption }}</p>
                            @endif
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-500">
                                    {{ $gallery->created_at->format('M j, Y') }}
                                </span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-xs font-medium">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this image?');" 
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
        </div>

        <!-- Pagination -->
        @if($galleries->hasPages())
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                {{ $galleries->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="bg-white shadow sm:rounded-lg">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No images found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if(request()->hasAny(['vehicle', 'featured']))
                        Try adjusting your filters or 
                        <a href="{{ route('admin.galleries.index') }}" class="text-blue-600 hover:text-blue-500">clear all filters</a>.
                    @else
                        Get started by adding your first gallery image.
                    @endif
                </p>
                <div class="mt-6">
                    <a href="{{ route('admin.galleries.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Image
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
