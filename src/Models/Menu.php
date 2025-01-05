<?php

namespace Lunestudio\FilamentNavigationManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'location',
        'name',
        'append_profile_item',
        'keep_on_mobile',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
