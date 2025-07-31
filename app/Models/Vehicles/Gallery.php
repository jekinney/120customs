<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'image_path',
        'caption',
        'alt_text',
        'is_featured',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Get the vehicle that owns the gallery.
     */
    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
