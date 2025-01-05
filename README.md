# Filament Navigation Manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lunestudio/filament-navigation-manager.svg?style=flat-square)](https://packagist.org/packages/lunestudio/filament-navigation-manager)
[![Total Downloads](https://img.shields.io/packagist/dt/lunestudio/filament-navigation-manager.svg?style=flat-square)](https://packagist.org/packages/lunestudio/filament-navigation-manager)

A menu management plugin for Filament.

<!-- docs_start -->

## Installation

You can install the package via composer:

```bash
composer require lunestudio/filament-navigation-manager
```

Then run the installation command to publish migrations and assets:

```bash
php artisan filament-navigation-manager:install
```

After that, you will need to add a plugin to your `AdminPanelProvider`

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->plugins([
            // ...$plugins,
            FilamentNavigationManagerPlugin::make(),
        ]);
}
```

To publish the config file, run:

```bash
php artisan vendor:publish --tag="filament-navigation-manager-config"
```

Here is the content of the published config file:

```php
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
            'label' => __('Users'),
            'model_prop_to_pluck' => 'name',
            'item_prop_to_text' => 'name',
            'route_name' => 'user',
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
```

Linkable items must consider the properties of the models and the attributes of the routes.

The properties `model_prop_to_pluck`, `item_prop_to_text`, and `model_prop_to_route` must be fillable.

At the same time, the `model_prop_to_route` property must be defined with the same name as the model property, and the route must be named.

An example for the linkable User is:

```php
Route::get('/users/{email}', function () {
    return view('dashboard');
})->name('user');
```

And in the model:

```php
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
    ];
}
```

## Menu Resource

This is the index page for creating menus.

<p align="center"><img src="/art/resource.png" alt="Menu Resource"></p>

You can define the following properties: `Name`, `Location`, `Append profile item` and `Keep on mobile`.

<p align="center"><img src="/art/edit-page.png" alt="Edit Menu"></p>

You can also add menu items and define: `Parent Item`, `Linkable Type`, `Linkable Id`, `Custom Link`, `Ícon`, `Name`, `Extra Classes` and `Link Target`.

<p align="center"><img src="/art/add-item.png" alt="Add Item"></p>

Afterward, you can reorder items by dragging and dropping them.

<p align="center"><img src="/art/reorder.png" alt="Reorder Items"></p>

## Menu Blade Component

To make it as easy as possible to output your menu, Lunestudio provides an
`<x-navigation-manager::menu>` blade component.

The default location is `main`, but you can change it to any registered menu location.

```html
<x-navigation-manager::menu />
<x-navigation-manager::menu menu-location="footer" />
```

This is the default view

<p align="center"><img src="/art/view.png" alt="Menu View"></p>

<!-- docs_end -->

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

-   [Lunestudio](https://github.com/Lunestudio)
-   [Lucio Negrello](https://github.com/whoisnegrello)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
