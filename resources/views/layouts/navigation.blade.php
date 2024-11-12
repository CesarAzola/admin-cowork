<nav x-data="{ open: false }" class="navbar navbar-expand-md navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-text-top" />
        </a>

        <button class="navbar-toggler" type="button" @click="open = ! open" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" :class="{ 'show': open }" id="navbarResponsive">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <x-nav-link :href="route('reservations.historic')" :active="request()->routeIs('reservations.historic')" class="nav-link">
                        {{ __('Reservas') }}
                    </x-nav-link>
                </li>
                @unless (auth()->user()->hasRole('client'))
                <li class="nav-item">
                    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" class="nav-link">
                        {{ __('Salas') }}
                    </x-nav-link>
                </li>
                @endunless
                <li class="nav-item">
                    <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')" class="nav-link">
                        {{ __('Reservar') }}
                    </x-nav-link>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                            @csrf
                            <a onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->

</nav>
