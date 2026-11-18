<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'description',
    'status',
])]
#[Hidden([])]
class ServiceType extends Model
{
    public function cabs(): HasMany
    {
        return $this->hasMany(Cab::class, 'service_type_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
