<?php

namespace Lunestudio\FilamentNavigationManager\Filament\Resources\MenuResource\RelationManagers;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Filament\Resources\RelationManagers\RelationManager;
use Lunestudio\FilamentNavigationManager\Helpers\ModelsHelper;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('parent_item_id')
                    ->relationship('parentItem', 'name', function (Builder $query, RelationManager $livewire) {
                        $query->where('menu_id', $livewire->ownerRecord->id)->whereNull('parent_item_id');
                    }, true),

                Select::make('linkable_type')
                    ->options(ModelsHelper::getLinkableOptions())
                    ->afterStateUpdated(function (Set $set) {
                        $set('custom_url', null);
                        $set('linkable_id', null);
                    })
                    ->reactive()
                    ->required(),

                Select::make('linkable_id')
                    ->options(function (Get $get) {
                        if (class_exists($get('linkable_type'))) {
                            $model_data = ModelsHelper::getModelData($get('linkable_type'));
                            return $model_data['model']::all()->pluck($model_data['model_prop_to_pluck'], 'id');
                        }
                    })
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        if ($get('linkable_type') && $get('linkable_type') !== 'custom' && $get('linkable_id')) {
                            $model_data = ModelsHelper::getModelData($get('linkable_type'));
                            $set('name', $model_data['model']::find($get('linkable_id'))?->{$model_data['item_prop_to_text']});
                        }
                    })
                    ->reactive()
                    ->columnSpanFull()
                    ->required(function (Get $get) {
                        return $get('linkable_type') && $get('linkable_type') !== 'custom';
                    }),

                IconPicker::make('icon')
                    ->columns(3),

                TextInput::make('name')
                    ->maxLength(255)
                    ->required(),

                TextInput::make('custom_url')
                    ->url()
                    ->columnSpanFull()
                    ->visible(function (Get $get) {
                        return $get('linkable_type') === 'custom';
                    })
                    ->required(),

                TextInput::make('attributes.class'),

                Select::make('attributes.target')
                    ->options([
                        '_blank' => __('New Tab'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('menu.name')
                    ->searchable(),

                TextColumn::make('parentItem.name')
                    ->default('--')
                    ->searchable(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('url')
                    ->searchable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_column')
            ->reorderable('order_column');
    }
}
