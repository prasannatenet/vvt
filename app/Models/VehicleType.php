<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'status'])]
#[Hidden([])]
class VehicleType extends Model
{
    public function cabs(): HasMany
    {
        return $this->hasMany(Cab::class, 'type', 'name');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
