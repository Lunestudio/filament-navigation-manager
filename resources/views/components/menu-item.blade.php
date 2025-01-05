<li
    @if ($item->attributes) {{ $attributes->class(['group'])->merge($item->attributes) }} @else {{ $attributes->class(['group']) }} @endif>
    <a @if ($item->attributes) {{ $attributes->merge($item->attributes) }} @endif href="{{ $item->url }}">
        @if ($item->icon)
            <x-icon class="w-5 h-5" name="{{ $item->icon }}" />
        @endif {{ $item->name }}
    </a>

    @if ($item->hasItems())
        <ul class="group-hover:max-h-fit">
            @foreach ($item->items as $item)
                <x-navigation-manager::menu-item :item="$item" />
            @endforeach
        </ul>
    @endif
</li>
