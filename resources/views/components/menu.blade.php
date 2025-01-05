@php
    $isMainMenuToMobile = $menu->keep_on_mobile && $menu->location === 'main';
@endphp

@if ($menu && count($menu->items) > 0)
    @if ($isMainMenuToMobile)
        <label for="menu-toggle" class="cursor-pointer p-2 lg:hidden">
            <x-heroicon-o-bars-3-bottom-right class="w-6 h-6" />
        </label>

        <input type="checkbox" id="menu-toggle" class="peer hidden">
    @endif

    <nav @class([
        'menu',
        "menu-{$menu->location}",
        'hidden lg:block' => !$menu->keep_on_mobile,
        'peer-checked:right-0 keep-on-mobile' => $isMainMenuToMobile,
    ])>
        @if ($isMainMenuToMobile)
            <label for="menu-toggle" class="cursor-pointer p-2 absolute top-4 right-4 lg:hidden">
                <x-heroicon-o-x-mark class="w-6 h-6" />
            </label>
        @endif

        <ul>
            @foreach ($menu->items as $item)
                @if ($item->url)
                    <x-navigation-manager::menu-item :item="$item" />
                @endif
            @endforeach

            @if ($menu->append_profile_item)
                <x-navigation-manager::menu-item-profile />
            @endif
        </ul>
    </nav>
@endif
