<?php

namespace Lunestudio\FilamentNavigationManager\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserName extends Component
{
    public function render(): View|Closure|string
    {
        return function (array $data) {
            return 'filament-navigation-manager::components.user-name';
        };
    }
}
