@php
    $user_id = Auth::id();
@endphp

<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#pablo">{{ $page_title or ''}}</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navigation">       
            <ul class="navbar-nav">                
                <li class="nav-item dropdown">
                <a id="navbarUsersDropdownMenuLink" class="nav-link dropdown-toggle" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Account</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarUsersDropdownMenuLink">
                        <a class="dropdown-item" href="/settings/profile/{{ $user_id }}">Perfil</a>
                        <a class="dropdown-item" href="/settings/users">Usuários</a>
                        <a class="dropdown-item" href="/about">Sobre</a>
                        <a class="dropdown-item" href="/login/out">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>