<?php

namespace Lunestudio\FilamentNavigationManager\Helpers;

class ModelsHelper
{
    public static function getAllModels(): array
    {
        return config('filament-navigation-manager.linkable', []);
    }

    public static function getLinkableOptions(): array
    {
        $models = self::getAllModels();

        return collect($models)
            ->filter(fn($label, $class) => class_exists($class))
            ->toArray()
            + ['custom' => __('Custom URL')];
    }
}
