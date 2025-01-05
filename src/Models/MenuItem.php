<?php

namespace Lunestudio\FilamentNavigationManager\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'menu_id',
        'parent_item_id',
        'is_trainings_item',
        'attributes',
        'icon',
        'name',
        'linkable_type',
        'linkable_id',
        'custom_url',
    ];

    protected $casts = [
        'attributes' => 'json',
    ];

    protected $appends = [
        'url',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parentItem(): BelongsTo
    {
        return $this->belongsTo($this::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany($this::class, 'parent_item_id', 'id');
    }

    public function url(): Attribute
    {
        $url = null;

        if (! empty($this->custom_url)) {
            $url = $this->custom_url;
        }

        if (! empty($this->linkable_type) && ! empty($this->linkable_id) && class_exists($this->linkable_type)) {
            $linkable = $this->linkable_type::find($this->linkable_id);

            if ($linkable?->slug) {
                $route_name = Str::kebab(class_basename($this->linkable_type));

                if (Route::has($route_name)) {
                    $url = route($route_name, ['slug' => $linkable->slug], false);
                }
            }
        }

        return Attribute::make(
            get: fn () => $url,
        );
    }

    public function hasItems(): bool
    {
        return $this->items->count() > 0;
    }
}
