@guest
    <li class="group">
        <a class="profile-item" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
    </li>
@endguest

@auth
    <li class="group">
        <a class="profile-item" href="{{ route('login') }}">
            <x-navigation-manager::user-name />
        </a>
    </li>
@endauth
