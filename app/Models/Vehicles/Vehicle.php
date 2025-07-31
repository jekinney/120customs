<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\Vehicles\VehicleFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'model',
        'year',
        'description',
        'brand_id',
        'type_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Get the type that owns the vehicle.
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the brand that owns the vehicle.
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    
    /**
     * Get all galleries associated with the vehicle.
     */
    public function galleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Get the featured gallery for the vehicle.
     */
    public function featuredGallery(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Gallery::class)->where('is_featured', true);
    }

    /**
     * Get all featured galleries for the vehicle.
     */
    public function featuredGalleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Gallery::class)->where('is_featured', true);
    }
}