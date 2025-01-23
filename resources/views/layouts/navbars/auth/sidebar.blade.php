<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="../assets/img/logo_er_turismo_sinfondo.png" class="navbar-brand-img h-100" alt="...">

        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item pb-2">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-table-columns" style="color: #020303;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Contable</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('partidas*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-plus fa-lg" style="color: #020303;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Partidas</span>
                </a>
                <div class="collapse {{ request()->is('partidas*') ? 'show' : '' }}"" id="collapseExample">
                    <a class="nav-sublink {{ request()->is('partidas') ? 'active' : '' }}" href="/partidas" >
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-magnifying-glass-dollar fa-lg" style="color: #020303;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ver Partidas</span>
                    </a>
                    <a class="nav-sublink {{ request()->is('partidas/upload') ? 'active' : '' }}" href="/partidas/upload" >
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-upload fa-lg" style="color: #020303;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cargar Partidas</span>
                    </a>
                    <a class="nav-sublink {{ request()->is('partidas/modificacion') ? 'active' : '' }}" href="/partidas/modificacion" >
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-right-left fa-lg" style="color: #020303;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Modif. Presupuestaria</span>
                    </a>
                  </div>
            </li>
            
            
            
            <li class="nav-item pb-2">
                <a class="nav-link {{ Route::currentRouteName() == 'links' ? 'active' : '' }}"
                    href="{{ route('links') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fa-solid fa-link ps-2 pe-2 text-center
                        {{ request()->is('links') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Links de Interés</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('static-sign-up') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-link ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(), ['user-management']) ? 'text-white' : 'text-dark' }}" style="font-size: 1rem;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-3 pt-3">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
            <div class="full-background"
                style="background-image: url('../assets/img/curved-images/white-curved.jpeg')">
            </div>
            <div class="card-body text-left p-3 w-100">

            </div>
        </div>
    </div>
</aside>
