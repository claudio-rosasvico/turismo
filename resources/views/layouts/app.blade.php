<x-layouts.base>
    {{-- If the user is authenticated --}}
    @auth()
        
            
            {{-- If the user is authenticated on the static sign up or the sign up page --}}
            @if (in_array(request()->route()->getName(),['static-sign-up', 'sign-up'],))
            @include('layouts.navbars.guest.sign-up')
            {{ $slot }}
            {{-- @include('layouts.footers.guest.with-socials') --}}
            {{-- If the user is authenticated on the static sign in or the login page --}}
            @elseif (in_array(request()->route()->getName(),['sign-in', 'login'],))
            @include('layouts.navbars.guest.login')
            {{ $slot }}
            @include('layouts.footers.guest.description')
            @elseif (in_array(request()->route()->getName(),['profile', 'my-profile'],))
            @unlessrole('Visitante')
            @include('layouts.navbars.auth.sidebar')
            @endunlessrole
            <div class="main-content position-relative bg-gray-100">
                @include('layouts.navbars.auth.nav-profile')
                <div>
                    {{ $slot }}
                    @include('layouts.footers.auth.footer')
                </div>
            </div>
            @else
            @unlessrole('Visitante')
            @include('layouts.navbars.auth.sidebar')
            @endunlessrole
            @include('layouts.navbars.auth.nav', ['title' => isset($title)? $title : ''])
            <nav>
            </nav>
            @unlessrole('Visitante')
            {{ $slot }}
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.auth.footer')
                    </div>
                </div>
            </main>
            @endunlessrole
            @role('Visitante')
            <div class="container mt-5">
                <div class="alert alert-info text-center" role="alert">
                    <h6>Todavía no tiene los permisos necesarios para acceder al sistema. Por favor contacte al administrador</h6>
                </div>
            </div>
            @endrole
            @endif

    @endauth

    {{-- If the user is not authenticated (if the user is a guest) --}}
    @guest
        {{-- If the user is on the login page --}}
        @if (!auth()->check() && in_array(request()->route()->getName(),['login'],))
            @include('layouts.navbars.guest.login')
            {{ $slot }}
            <div class="mt-5">
                @include('layouts.footers.auth.footer')
            </div>

            {{-- If the user is on the sign up page --}}
        @elseif (!auth()->check() && in_array(request()->route()->getName(),['sign-up'],))
            <div>
                @include('layouts.navbars.guest.sign-up')
                {{ $slot }}
                @include('layouts.footers.auth.footer')
            </div>
        @endif
    @endguest

</x-layouts.base>
