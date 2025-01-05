@if (auth()?->user()?->user_image)
    <div class="flex-shrink-0">
        <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->user_image }}" alt="{{ auth()->user()->name }}">
    </div>
@else
    <p>{{ auth()->user()->name }}</p>
@endif
