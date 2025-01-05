# Filament Navigation Manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lunestudio/filament-navigation-manager.svg?style=flat-square)](https://packagist.org/packages/lunestudio/filament-navigation-manager)
[![Total Downloads](https://img.shields.io/packagist/dt/lunestudio/filament-navigation-manager.svg?style=flat-square)](https://packagist.org/packages/lunestudio/filament-navigation-manager)

A menu manager plugin for Filament.

<!-- docs_start -->

## Installation

You can install the package via composer then run the installation command:

```bash
composer require lunestudio/filament-navigation-manager
```

Publish migrations and assets:

```bash
php artisan filament-navigation-manager:install
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-navigation-manager-config"
```

This is the contents of the published config file:

```php
return [
    'linkeables' => [
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
```

These configuration values define the defaults for all usage of the field and column. They
can be overridden on a per field or column basis.

## Menu Resource

This is the index page to create navigations.

<p align="center"><img src="/art/resource.png" alt="Menu Resource"></p>

You can define `Name`, `Location`, `Append profile item` and `Keep on mobile` props.

<p align="center"><img src="/art/edit-page.png" alt="Edit Menu"></p>

Also you can add menu items and define `Parent Item`, `Linkeable Type`, `Linkeable Id`, `Custom Link`, `Ícon`, `Name`, `Extra Classes` and `Link Target`.

<p align="center"><img src="/art/add-item.png" alt="Add Item"></p>

After you can reorder items draging and droping.

<p align="center"><img src="/art/reorder.png" alt="Reorder Items"></p>

## Menu Blade Component

To make it as easy as possible to output your menu, Lunestudio comes with an
`<x-navigation-manager::menu>` blade component.

Default location is `main`, but you can change for your registered menus.

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
