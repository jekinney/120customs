<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicles\Gallery;
use App\Models\Vehicles\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::with('vehicle');
        
        // Filter by vehicle
        if ($request->filled('vehicle')) {
            $query->where('vehicle_id', $request->vehicle);
        }
        
        // Filter by featured status
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured == '1');
        }
        
        $galleries = $query->latest()->paginate(24);
        $vehicles = Vehicle::orderBy('name')->get();
        
        return view('admin.galleries.index', compact('galleries', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::with(['brand', 'type'])->orderBy('name')->get();
        return view('admin.galleries.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // Allow up to 5MB
            'featured_index' => ['required', 'integer', 'min:0'],
        ]);

        $uploadedImages = [];
        $existingImages = Gallery::where('vehicle_id', $validated['vehicle_id'])->count();
        $featuredIndex = (int) $validated['featured_index'];
        
        // If this vehicle already has images, unfeatured them all first
        if ($existingImages > 0) {
            Gallery::where('vehicle_id', $validated['vehicle_id'])
                   ->update(['is_featured' => false]);
        }
        
        foreach ($request->file('images') as $index => $image) {
            $imagePath = $this->processAndStoreImage($image, 'vehicles/gallery');
            
            // Set featured based on user selection, or first image if no existing images
            $isFeatured = ($index === $featuredIndex) || ($existingImages === 0 && $index === 0);
            
            $gallery = Gallery::create([
                'vehicle_id' => $validated['vehicle_id'],
                'image_path' => $imagePath,
                'caption' => null,
                'alt_text' => null,
                'is_featured' => $isFeatured,
            ]);
            
            $uploadedImages[] = $gallery;
        }

        return redirect()->route('admin.vehicles.show', $validated['vehicle_id'])
            ->with('success', count($uploadedImages) . ' images uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('vehicle');
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $vehicles = Vehicle::with(['brand', 'type'])->orderBy('name')->get();
        $gallery->load('vehicle');
        return view('admin.galleries.edit', compact('gallery', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // Allow up to 5MB
            'caption' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['boolean'],
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        // Handle vehicle change - if vehicle is changed, check if new vehicle needs a featured image
        $vehicleChanged = $gallery->vehicle_id != $validated['vehicle_id'];
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $this->processAndStoreImage($request->file('image'), 'vehicles/gallery');
        }

        // If this image should be featured, unfeatured all others for this vehicle
        if ($validated['is_featured']) {
            Gallery::where('vehicle_id', $validated['vehicle_id'])
                   ->where('id', '!=', $gallery->id)
                   ->update(['is_featured' => false]);
        }
        
        // If this was the only featured image and we're unfeaturing it, make sure another one becomes featured
        if (!$validated['is_featured'] && $gallery->is_featured) {
            $otherImages = Gallery::where('vehicle_id', $validated['vehicle_id'])
                                ->where('id', '!=', $gallery->id)
                                ->count();
            
            if ($otherImages > 0) {
                // Make the first other image featured
                Gallery::where('vehicle_id', $validated['vehicle_id'])
                       ->where('id', '!=', $gallery->id)
                       ->first()
                       ->update(['is_featured' => true]);
            }
        }

        $gallery->update($validated);
        
        // If vehicle changed, handle the old vehicle's featured status
        if ($vehicleChanged) {
            $this->ensureFeaturedImageExists($gallery->getOriginal('vehicle_id'));
        }
        
        // Ensure the new vehicle has a featured image
        $this->ensureFeaturedImageExists($validated['vehicle_id']);

        return redirect()->route('admin.vehicles.show', $gallery->vehicle_id)
            ->with('success', 'Gallery image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $vehicleId = $gallery->vehicle_id;
        $wasFeatured = $gallery->is_featured;
        
        // Delete image file
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();
        
        // If the deleted image was featured, make another image featured
        if ($wasFeatured) {
            $this->ensureFeaturedImageExists($vehicleId);
        }

        return redirect()->route('admin.vehicles.show', $vehicleId)
            ->with('success', 'Gallery image deleted successfully.');
    }

    /**
     * Upload multiple images for a specific vehicle via AJAX
     */
    public function uploadForVehicle(Request $request, Vehicle $vehicle)
    {
        try {
            $validated = $request->validate([
                'images' => ['required', 'array', 'min:1'],
                'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // Allow up to 5MB
                'featured_index' => ['required', 'integer', 'min:0'],
            ]);

            $uploadedImages = [];
            $existingImages = Gallery::where('vehicle_id', $vehicle->id)->count();
            $featuredIndex = (int) $validated['featured_index'];
            
            // If this vehicle already has images, unfeatured them all first
            if ($existingImages > 0) {
                Gallery::where('vehicle_id', $vehicle->id)
                       ->update(['is_featured' => false]);
            }
            
            foreach ($request->file('images') as $index => $image) {
                try {
                    $imagePath = $this->processAndStoreImage($image, 'vehicles/gallery');
                    
                    // Set featured based on user selection, or first image if no existing images
                    $isFeatured = ($index === $featuredIndex) || ($existingImages === 0 && $index === 0);
                    
                    $gallery = Gallery::create([
                        'vehicle_id' => $vehicle->id,
                        'image_path' => $imagePath,
                        'caption' => null,
                        'alt_text' => $vehicle->name . ' - Gallery Image',
                        'is_featured' => $isFeatured,
                    ]);
                    
                    $uploadedImages[] = [
                        'id' => $gallery->id,
                        'url' => Storage::url($gallery->image_path),
                        'caption' => $gallery->caption,
                        'alt_text' => $gallery->alt_text,
                        'is_featured' => $gallery->is_featured,
                    ];
                } catch (\Exception $e) {
                    \Log::error('Failed to process image ' . $index . ': ' . $e->getMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to process image ' . ($index + 1) . ': ' . $e->getMessage()
                    ], 500);
                }
            }

            return response()->json([
                'success' => true,
                'message' => count($uploadedImages) . ' images uploaded successfully.',
                'images' => $uploadedImages
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Gallery upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Ensure a vehicle has at least one featured image
     */
    private function ensureFeaturedImageExists($vehicleId)
    {
        $featuredCount = Gallery::where('vehicle_id', $vehicleId)
                               ->where('is_featured', true)
                               ->count();
                               
        if ($featuredCount === 0) {
            // Make the first available image featured
            $firstImage = Gallery::where('vehicle_id', $vehicleId)->first();
            if ($firstImage) {
                $firstImage->update(['is_featured' => true]);
            }
        }
    }

    /**
     * Process and store an image with automatic resizing if needed
     */
    private function processAndStoreImage($uploadedFile, $storagePath)
    {
        // Get file size in bytes
        $fileSizeBytes = $uploadedFile->getSize();
        $maxSizeBytes = 2 * 1024 * 1024; // 2MB in bytes
        
        // Generate a unique filename
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $fullStoragePath = $storagePath . '/' . $filename;
        
        // If file is 2MB or smaller, store it directly
        if ($fileSizeBytes <= $maxSizeBytes) {
            return $uploadedFile->storeAs($storagePath, $filename, 'public');
        }
        
        // File is larger than 2MB, process with image compression
        try {
            // Try Intervention Image first
            $manager = new ImageManager(new Driver());
            $image = $manager->read($uploadedFile->getRealPath());
            
            // Get current dimensions
            $width = $image->width();
            $height = $image->height();
            
            // Calculate new dimensions if image is too large
            $maxDimension = 2000;
            if ($width > $maxDimension || $height > $maxDimension) {
                if ($width > $height) {
                    $newWidth = $maxDimension;
                    $newHeight = intval(($height / $width) * $maxDimension);
                } else {
                    $newHeight = $maxDimension;
                    $newWidth = intval(($width / $height) * $maxDimension);
                }
                $image->resize($newWidth, $newHeight);
            }
            
            // Try different quality levels to get under 2MB
            $qualities = [85, 75, 65, 55, 45, 35];
            $encoded = null;
            $finalQuality = 85;
            
            foreach ($qualities as $quality) {
                $encoded = $image->encodeByExtension($extension, quality: $quality);
                $currentSize = strlen($encoded->toString());
                
                if ($currentSize <= $maxSizeBytes) {
                    $finalQuality = $quality;
                    break;
                }
            }
            
            // Store the processed image
            $fullPath = storage_path('app/public/' . $fullStoragePath);
            
            // Ensure directory exists
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Save the processed image
            file_put_contents($fullPath, $encoded->toString());
            
            \Log::info("Image processed with Intervention Image: Original size: " . round($fileSizeBytes / 1024 / 1024, 2) . "MB, Final size: " . round(strlen($encoded->toString()) / 1024 / 1024, 2) . "MB, Quality: {$finalQuality}%");
            
            return $fullStoragePath;
            
        } catch (\Exception $e) {
            \Log::warning('Intervention Image processing failed, trying GD fallback: ' . $e->getMessage());
            
            // Fallback to PHP GD library
            return $this->processImageWithGD($uploadedFile, $storagePath, $maxSizeBytes);
        }
    }
    
    /**
     * Fallback image processing using PHP GD library
     */
    private function processImageWithGD($uploadedFile, $storagePath, $maxSizeBytes)
    {
        try {
            $tempPath = $uploadedFile->getRealPath();
            $mimeType = $uploadedFile->getMimeType();
            
            // Create image resource based on mime type
            switch ($mimeType) {
                case 'image/jpeg':
                    $source = imagecreatefromjpeg($tempPath);
                    break;
                case 'image/png':
                    $source = imagecreatefrompng($tempPath);
                    break;
                case 'image/gif':
                    $source = imagecreatefromgif($tempPath);
                    break;
                case 'image/webp':
                    $source = imagecreatefromwebp($tempPath);
                    break;
                default:
                    throw new \Exception('Unsupported image type: ' . $mimeType);
            }
            
            if (!$source) {
                throw new \Exception('Failed to create image resource');
            }
            
            // Get dimensions
            $originalWidth = imagesx($source);
            $originalHeight = imagesy($source);
            
            // Calculate new dimensions if needed
            $maxDimension = 2000;
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;
            
            if ($originalWidth > $maxDimension || $originalHeight > $maxDimension) {
                if ($originalWidth > $originalHeight) {
                    $newWidth = $maxDimension;
                    $newHeight = intval(($originalHeight / $originalWidth) * $maxDimension);
                } else {
                    $newHeight = $maxDimension;
                    $newWidth = intval(($originalWidth / $originalHeight) * $maxDimension);
                }
            }
            
            // Create new image
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency for PNG and GIF
            if ($mimeType === 'image/png' || $mimeType === 'image/gif') {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                imagefill($resized, 0, 0, $transparent);
            }
            
            // Resize the image
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
            
            // Generate filename and path
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $fullStoragePath = $storagePath . '/' . $filename;
            $fullPath = storage_path('app/public/' . $fullStoragePath);
            
            // Ensure directory exists
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Try different quality levels
            $qualities = [85, 75, 65, 55, 45, 35];
            $saved = false;
            $finalQuality = 85;
            
            foreach ($qualities as $quality) {
                // Save with current quality
                $tempFile = tempnam(sys_get_temp_dir(), 'img_resize_');
                
                switch ($mimeType) {
                    case 'image/jpeg':
                        imagejpeg($resized, $tempFile, $quality);
                        break;
                    case 'image/png':
                        // PNG doesn't use quality the same way, use compression level
                        $compression = intval((100 - $quality) / 10);
                        imagepng($resized, $tempFile, $compression);
                        break;
                    case 'image/gif':
                        imagegif($resized, $tempFile);
                        break;
                    case 'image/webp':
                        imagewebp($resized, $tempFile, $quality);
                        break;
                }
                
                // Check file size
                if (file_exists($tempFile) && filesize($tempFile) <= $maxSizeBytes) {
                    // Move to final location
                    rename($tempFile, $fullPath);
                    $saved = true;
                    $finalQuality = $quality;
                    break;
                } else if (file_exists($tempFile)) {
                    unlink($tempFile);
                }
            }
            
            // Clean up
            imagedestroy($source);
            imagedestroy($resized);
            
            if (!$saved) {
                // Last resort: save with lowest quality
                switch ($mimeType) {
                    case 'image/jpeg':
                        imagejpeg($resized, $fullPath, 30);
                        break;
                    case 'image/png':
                        imagepng($resized, $fullPath, 9);
                        break;
                    case 'image/gif':
                        imagegif($resized, $fullPath);
                        break;
                    case 'image/webp':
                        imagewebp($resized, $fullPath, 30);
                        break;
                }
                $finalQuality = 30;
            }
            
            $finalSize = file_exists($fullPath) ? filesize($fullPath) : 0;
            \Log::info("Image processed with GD: Original size: " . round($uploadedFile->getSize() / 1024 / 1024, 2) . "MB, Final size: " . round($finalSize / 1024 / 1024, 2) . "MB, Quality: {$finalQuality}%");
            
            return $fullStoragePath;
            
        } catch (\Exception $e) {
            \Log::error('GD image processing also failed: ' . $e->getMessage());
            
            // Last resort: store original file
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            return $uploadedFile->storeAs($storagePath, $filename, 'public');
        }
    }
}
