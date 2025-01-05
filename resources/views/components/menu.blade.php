@php
    $isMainMenuToMobile = $menu->keep_on_mobile && $menu->location === 'main';
@endphp

@if ($menu && count($menu->items) > 0)
    <div class="menu-container">
        @if ($isMainMenuToMobile)
            <label for="menu-toggle" class="menu-toggle">
                <x-heroicon-o-bars-3-bottom-right class="w-6 h-6" />
            </label>

            <input type="checkbox" id="menu-toggle" class="menu-toggle-input peer">
        @endif

        <nav @class([
            'menu',
            "menu-{$menu->location}",
            'not-keep-on-mobile' => !$menu->keep_on_mobile,
            'keep-on-mobile' => $isMainMenuToMobile,
        ])>
            @if ($isMainMenuToMobile)
                <label for="menu-toggle" class="menu-toggle-close">
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
    </div>
@endif
