<!DOCTYPE html>
<html lang="pt_br">
<head>
    <title>@yield('page_title', 'Vercan - Admin')</title>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('inc.styles.main')

    <!-- Specific -->
    @yield('styles')
</head>
<body id="{{ $page or 'default'}}" class="sidebar-mini">      
    <div class="wrapper">          
            <!-- left area -->
            @include('inc.menu')

            <div class="main-panel">
                @include('inc.header')               
                
                @yield('content')  

                @include('inc.footer') 
            </div>
        </div>
    </div> 

    <div id="loading" class="loading-layer" style="display:none">
        <img src="/img/loading.gif"/>
    </div>

    @include('inc.scripts.main')
    <!-- Specific -->
    @yield('scripts')
</body>
</html>
