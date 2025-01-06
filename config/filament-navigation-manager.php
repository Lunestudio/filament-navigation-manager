<?php

return [
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

    'linkable' => [
        [
            'model' => \App\Models\User::class,
            'label' => class_basename(\App\Models\User::class),
            'model_prop_to_pluck' => 'name',
            'item_prop_to_text' => 'name',
            'route_name' => \Illuminate\Support\Str::kebab(class_basename(\App\Models\User::class)),
            'model_prop_to_route' => 'email',
        ],
        // [
        //     'model' => $full_class_name,
        //     'label' => $text_label_to_linkable_type_select,
        //     'model_prop_to_pluck' => $fillable_name,
        //     'item_prop_to_text' => $fillable_name,
        //     'route_name' => $route_name,
        //     'model_prop_to_route' => $fillable_name_and_route_attr,
        // ],
    ],
];
