<nav class="navbar navbar-expand-lg" style="background-color: #ffffff; min-height: 70px; border-bottom: 2px solid #dc3545;">
    <div class="container">
        <!-- Logo e Título -->
        <a class="navbar-brand d-flex align-items-center text-danger fw-bold" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-text-top me-2" />
            CINERIPE
        </a>

        <!-- Botão Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-danger fw-bold @if(request()->routeIs('dashboard')) active @endif" 
                       href="{{ route('dashboard') }}">
                        CINERIPE
                    </a>
                </li>
            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white bg-danger px-3 rounded" href="#" id="userDropdown" 
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-danger" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">{{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white bg-danger px-3 rounded" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
