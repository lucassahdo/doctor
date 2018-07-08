@php
$user_id = Auth::id();
@endphp
    
<div class="sidebar" data-color="black">
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            <img src="/img/logo_1.png">
        </a>

        <a href="/" class="simple-text logo-normal">
            <img src="/img/logo_2.png">
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">            
            <h2 class="sidebar-group-title">Geral</h2>

            @php
                $route = "/dashboard";
                $route_name = "dashboard";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <h2 class="sidebar-group-title">Consultas</h2>                

            @php
                $route = "/schedule/new";
                $route_name = "schedule.new";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons ui-1_simple-add"></i>
                    <p>Nova</p>
                </a>
            </li>

            @php
                $route = "/schedule/manage";
                $route_name = "schedule.manage";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons business_briefcase-24"></i>
                    <p>Gerenciar</p>
                </a>
            </li>

            
            <h2 class="sidebar-group-title">Configurações</h2>

            @php
                $route = "/settings/profile/$user_id";
                $route_name = "settings.profile";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Perfil</p>
                </a>
            </li> 
            

            
            @php
                $route = "/settings/users";
                $route_name = "settings.users";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Usuários</p>
                </a>
            </li>    
            
            @php
                $route = "/settings/preferences";
                $route_name = "settings.preferences";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons ui-1_settings-gear-63"></i>
                    <p>Preferências</p>
                </a>
            </li>               

            <h2 class="sidebar-group-title">Extra</h2>

            @php
                $route = "/about";
                $route_name = "about";
            @endphp

            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a href="{{ $route }}">
                    <i class="now-ui-icons objects_planet"></i>
                    <p>Sobre</p>
                </a>
            </li>

            <h2 class="sidebar-group-title">Sessão</h2>
            
            @php
                $route = "/login/out";
                $route_name = "login.out";
            @endphp
            <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                <a id="menu_logout" href="{{ $route }}">
                    <i class="now-ui-icons media-1_button-power"></i>
                    <p>Sair</p>
                </a>
            </li>       
        </ul>
    </div>
</div>