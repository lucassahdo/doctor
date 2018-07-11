@extends('layout.base') 

@section('styles')
<link rel="stylesheet" href="/css/pages/profile.css"/>
@endsection

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8 center">
            <div class="card card-user">
                <div class="image">
                    <img src="/img/bg5.jpg" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            <img class="avatar border-gray" src="/img/user.png" alt="...">
                            <h5 class="title">{{ $user->title or 'Cadastrar Usuário' }}</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 center">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Perfil</h5>
                </div>
                <div class="card-body">
                    @php 
                        $form_action = isset($user) ? "/settings/user/update/$user->id" : "/settings/user/create";
                    @endphp
                    <form id="form_profile" action="{{ $form_action }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $user->name or ''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sobrenome</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="Sobrenome" value="{{ $user->lastname or '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" name="email" class="form-control" placeholder="Sobrenome" value="{{ $user->email or '' }}">
                                </div>
                            </div> 
                            @if (isset($user))   
                                <div class="col-md-12">     
                                    <br>                           
                                    <p class="category">Alterar senha</p>
                                    <input id="enable_password" type="checkbox" name="checkbox" class="bootstrap-switch" data-on-label="S" data-off-label="N" />                                                       
                                </div>                  
                                <div class="col-md-12 password-area">
                                    <div class="form-group">
                                        <label>Nova Senha</label>
                                        <input disabled type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 password-area">
                                    <div class="form-group">
                                        <label>Repita a Senha</label>
                                        <input disabled type="password" name="_password" class="form-control">
                                    </div>
                                </div>
                            @else                
                                <div class="col-md-12 password-area">
                                    <div class="form-group">
                                        <label>Nova Senha</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 password-area">
                                    <div class="form-group">
                                        <label>Repita a Senha</label>
                                        <input type="password" name="_password" class="form-control">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 center">      
                <div class="row">
                    <div class="col-md-6">
                        <button id="btn-cancel" class="btn btn-primary btn-round btn-danger">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                            Cancelar
                        </button>  
                    </div>
                    <div class="col-md-6">
                        <button id="btn-save" class="btn btn-primary btn-round btn-save">
                            <i class="now-ui-icons ui-1_check"></i>
                            Salvar
                        </button>  
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/cdn/jquery/jquery.validate.min.js"></script>
<script src="/cdn/mascara_js/mascara.min.js"></script>
<script src="/js/pages/profile.js"></script>
@endsection
