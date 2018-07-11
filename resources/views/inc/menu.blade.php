@php
$user_id = Auth::id();
@endphp
    
<div class="sidebar" data-color="doctor">
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            <h1 class="logo-main">D</h1>
        </a>

        <a href="/" class="simple-text logo-normal">            
            <h1 class="logo-text">DOCTOR</h1>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">            
            <h2 class="sidebar-group-title">Administração</h2>  

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

            @php
                if (
                    !empty(AppUtils::isActiveRoute('schedule.new')) ||
                    !empty(AppUtils::isActiveRoute('schedule.manage'))
                ) {
                    $active = 'active';
                } 
                else {
                    $active = null;
                }
            @endphp
            <li class="{{ $active }}">
                <a data-toggle="collapse" href="#menu_schedule">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>
                        Consultas
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="menu_schedule">
                    <ul class="nav">
                        @php
                            $route = "/schedule/new";
                            $route_name = "schedule.new";
                        @endphp
                        <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                            <a href="{{ $route }}">
                                <span class="sidebar-mini-icon">N</span>
                                <span class="sidebar-normal">Nova Consulta</span>
                            </a>
                        </li>
                        @php
                            $route = "/schedule/manage";
                            $route_name = "schedule.manage";
                        @endphp
                        <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                            <a href="{{ $route }}">
                                <span class="sidebar-mini-icon">G</span>
                                <span class="sidebar-normal">Gerenciar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @php
                if (
                    !empty(AppUtils::isActiveRoute('patient.new')) ||
                    !empty(AppUtils::isActiveRoute('patient.manage'))
                ) {
                    $active = 'active';
                } 
                else {
                    $active = null;
                }
            @endphp
            <li class="{{ $active }}">
                <a data-toggle="collapse" href="#menu_patients">
                    <i class="now-ui-icons health_ambulance"></i>
                    <p>
                        Pacientes
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="menu_patients">
                    <ul class="nav">
                        @php
                            $route = "/patient/new";
                            $route_name = "patient.new";
                        @endphp
                        <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                            <a href="{{ $route }}">
                                <span class="sidebar-mini-icon">N</span>
                                <span class="sidebar-normal">Novo</span>
                            </a>
                        </li>
                        @php
                            $route = "/patient/manage";
                            $route_name = "patient.manage";
                        @endphp
                        <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                            <a href="{{ $route }}">
                                <span class="sidebar-mini-icon">G</span>
                                <span class="sidebar-normal">Gerenciar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @php
                if (
                    !empty(AppUtils::isActiveRoute('doctor.manage')) ||
                    !empty(AppUtils::isActiveRoute('attendant.manage'))
                ) {
                    $active = 'active';
                } 
                else {
                    $active = null;
                }
            @endphp
            <li class="{{ $active }}">
                <a data-toggle="collapse" href="#menu_employees">
                    <i class="now-ui-icons business_badge"></i>
                    <p>
                        Funcionários
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="menu_employees">
                    <ul class="nav">
                        @php
                            $route = "/doctor/manage";
                            $route_name = "doctor.manage";
                        @endphp
                        <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                            <a href="{{ $route }}">
                                <span class="sidebar-mini-icon">M</span>
                                <span class="sidebar-normal">Médicos</span>
                            </a>
                        </li>
                        @php
                            $route = "/attendant/manage";
                            $route_name = "attendant.manage";
                        @endphp
                        <li class="{{ AppUtils::isActiveRoute($route_name) }}">
                            <a href="{{ $route }}">
                                <span class="sidebar-mini-icon">A</span>
                                <span class="sidebar-normal">Atendentes</span>
                            </a>
                        </li>
                    </ul>
                </div>
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
            
            <!-- 
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
            -->

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