<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Vercan - Admin</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/now-ui-dashboard.css?v=1.1.0"/>
    <link rel="stylesheet" href="/css/pages/login.css"/>
</head>
<body class="sidebar-mini">
    <section>
        <div class="wrapper wrapper-full-page ">
            <div class="full-page login-page">
                <div class="content">
                    <div class="container">
                        <div class="col-md-5 ml-auto mr-auto">
                            <form id="formLogin" class="form" method="post" action="/login/in">
                                {{ csrf_field() }}
                                <div class="card card-login card-plain">
                                    <div class="card-header ">
                                        <div class="logo-container">
                                            <h1 class="logo-text">DOCTOR</h1>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="input-group no-border form-control-lg">
                                            <span class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="now-ui-icons users_circle-08"></i>
                                                </div>
                                            </span>
                                            <input name="email" type="text" class="form-control" placeholder="E-mail">
                                        </div>
                                        <div class="input-group no-border form-control-lg">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="now-ui-icons text_caps-small"></i>
                                                </div>
                                            </div>
                                            <input name="password" type="password" placeholder="Senha" class="form-control">
                                        </div>

                                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    </div>
                                    <div class="card-footer ">
                                        <a id="btnSubmit" href="javascript:{}" class="btn btn-primary btn-round btn-lg btn-block mb-3">INICIAR</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>      
    </section>

    <!--   Core JS Files   -->
    <script src="/js/core/jquery.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>
    <script src="/js/plugins/sweetalert2.min.js"></script>
    <script src="/js/pages/login.js"></script>
</body>
</html>