<?php

namespace Lunestudio\FilamentNavigationManager\Filament\Resources;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Config;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Lunestudio\FilamentNavigationManager\Filament\FilamentNavigationManagerPlugin;
use Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource\Pages\EditMenu;
use Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource\Pages\ListMenus;
use Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource\Pages\CreateMenu;
use Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource\RelationManagers\ItemsRelationManager;

class MenuResource extends Resource
{
    public static function getModel(): string
    {
        return config('filament-navigation-manager.model');
    }

    public static function getModelLabel(): string
    {
        return FilamentNavigationManagerPlugin::get()->getLabel();
    }

    public static function getPluralModelLabel(): string
    {
        return FilamentNavigationManagerPlugin::get()->getPluralLabel();
    }

    public static function getNavigationLabel(): string
    {
        return FilamentNavigationManagerPlugin::get()->getNavigationLabel() ?? Str::title(static::getPluralModelLabel()) ?? Str::title(static::getModelLabel());
    }

    public static function getNavigationIcon(): string
    {
        return FilamentNavigationManagerPlugin::get()->getNavigationIcon();
    }

    public static function getNavigationSort(): ?int
    {
        return FilamentNavigationManagerPlugin::get()->getNavigationSort();
    }

    public static function getNavigationGroup(): ?string
    {
        return FilamentNavigationManagerPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationBadge(): ?string
    {
        return FilamentNavigationManagerPlugin::get()->getNavigationCountBadge()
            ? number_format(static::getModel()::count())
            : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255)
                    ->required(),

                TextInput::make('location')
                    ->maxLength(255)
                    ->required(),

                Toggle::make('append_profile_item'),

                Toggle::make('keep_on_mobile'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('location')
                    ->searchable(),

                ToggleColumn::make('append_profile_item'),

                ToggleColumn::make('keep_on_mobile'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }
}
