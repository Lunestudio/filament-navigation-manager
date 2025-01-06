<?php

namespace Lunestudio\FilamentNavigationManager\Helpers;

class ModelsHelper
{
    public static function getAllModels(): array
    {
        return config('filament-navigation-manager.linkable', []);
    }

    public static function getModelData(string $class): array|null
    {
        if (!class_exists($class)) {
            return null;
        }

        $models = self::getAllModels();
        return collect(array_filter($models, fn($item) => $item['model'] === $class))->first();
    }

    public static function getLinkableOptions(): array
    {
        $models = self::getAllModels();

        return collect($models)
            ->filter(function ($linkable) {
                $linkable_attrs = (new $linkable['model']())->getFillable();

                return
                    class_exists($linkable['model'])
                    && in_array($linkable['model_prop_to_pluck'], $linkable_attrs)
                    && in_array($linkable['model_prop_to_route'], $linkable_attrs)
                    && in_array($linkable['item_prop_to_text'], $linkable_attrs);
            })
            ->mapWithKeys(fn($linkable) => [$linkable['model'] => $linkable['label']])
            ->toArray()
            + ['custom' => __('Custom URL')];
    }
}
