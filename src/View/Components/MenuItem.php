<?php

namespace Lunestudio\FilamentNavigationManager\View\Components;

use Lunestudio\FilamentNavigationManager\Models\MenuItem as ModelsMenuItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public function __construct(public ModelsMenuItem $item) {}

    public function render(): View|Closure|string
    {
        return function (array $data) {
            return 'filament-navigation-manager::components.menu-item';
        };
    }
}
