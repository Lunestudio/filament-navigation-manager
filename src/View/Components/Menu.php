<?php

namespace Lunestudio\FilamentNavigationManager\View\Components;

use Lunestudio\FilamentNavigationManager\Models\Menu as MenuModel;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Menu extends Component
{
    public ?MenuModel $menu;

    public function __construct(public ?string $menuLocation = 'main')
    {
        $this->menu = MenuModel::where('location', $this->menuLocation)
            ->orWhere('location', 'main')
            ->with([
                'items' => function ($items_query) {
                    $items_query->whereNull('parent_item_id')->with('items')->ordered()->get();
                },
            ])
            ->orderByRaw("location = ? DESC", [$this->menuLocation])
            ->first();
    }

    public function render(): View|Closure|string
    {
        if (!$this->menu) {
            return '';
        }

        return function (array $data) {
            return 'filament-navigation-manager::components.menu';
        };
    }
}
