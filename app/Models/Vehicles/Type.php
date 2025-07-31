<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get all vehicles for this type.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
