<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all vehicles for this brand.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
