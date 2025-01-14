<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
    <div class="container" style="background-color: black; opacity: 0.5;" >

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                @if (auth()->user())
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center me-2 active" aria-current="page"
                            href="{{ route('dashboard') }}">
                            <i class="fa fa-chart-pie opacity-15  me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white me-2" href="{{ route('profile') }}">
                            <i class="fa fa-user opacity-15  me-1"></i>
                            Perfil
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-white me-2" href="{{ auth()->user() ? route('static-sign-up') : route('sign-up') }}">
                        <i class="fas fa-user-circle opacity-15  me-1"></i>
                        Registrarse
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white me-2" href="{{ auth()->user() ? route('sign-in') : route('login') }}">
                        <i class="fas fa-key opacity-15  me-1"></i>
                        Iniciar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
