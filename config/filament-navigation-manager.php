<?php

return [
    'linkable' => [
        // namespace => label,
        // \App\Models\Page::class => class_basename(\App\Models\Page::class),
        // \App\Models\Page::class => __('Page'),
        \App\Models\User::class => class_basename(\App\Models\User::class),
    ],

    'model' => \Lunestudio\FilamentNavigationManager\Models\Menu::class,

    'resources' => [
        'label' => 'Menu',
        'plural_label' => 'Menus',
        'navigation_group' => null,
        'navigation_label' => 'Menus',
        'navigation_icon' => 'heroicon-o-list-bullet',
        'navigation_sort' => null,
        'navigation_count_badge' => false,
        'resource' => \Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource::class,
    ],
];
