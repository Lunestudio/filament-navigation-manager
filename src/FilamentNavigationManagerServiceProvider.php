<?php

namespace Lunestudio\FilamentNavigationManager;

use Illuminate\Console\Command;
use Filament\Support\Assets\Css;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Filament\Support\Facades\FilamentAsset;
use Lunestudio\FilamentNavigationManager\Models\Menu;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource;

class FilamentNavigationManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-navigation-manager')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                '2025_01_04_232023_create_menus_table',
                '2025_01_04_232201_create_menu_items_table',
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->endWith(function (Command $artisan) {
                        $artisan->call('filament:assets');
                    });
            });
    }

    public function packageBooted(): void
    {
        app()->bind(Menu::class, config('filament-navigation-manager.model'));
        app()->bind(MenuResource::class, config('filament-navigation-manager.resources.resource'));

        Blade::componentNamespace('Lunestudio\\FilamentNavigationManager\\View\\Components', 'navigation-manager');

        FilamentAsset::register([
            Css::make('styles', __DIR__ . '/../dist/css/styles.css'),
        ], 'lunestudio/filament-navigation-manager');
    }
}
