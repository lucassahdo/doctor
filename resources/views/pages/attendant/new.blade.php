@extends('layout.base') 

@section('styles')
<link rel="stylesheet" href="/css/pages/attendant_new.css"/>
@endsection

@section('content')
<div class="panel-header panel-header-sm">
</div>

<div class="content">
    @php 
        $form_action = isset($attendant) ? "/attendant/update/$attendant->id" : "/attendant/create";        
    @endphp
    <form id="form_attendant" method="post" action="{{ $form_action }}" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 center">    
                <div class="card pessoa">
                    <div class="card-header">
                        <h4 class="card-title">Sobre o(a) Atendente</h4>
                    </div>
                    <div class="card-body">                           
                        <div class="group center">
                            <div class="form-group has-label">
                                <label>
                                    Nome
                                </label>
                                <input class="form-control" value="{{ $attendant->name or '' }}" name="name" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Sobrenome
                                </label>
                                <input class="form-control" value="{{ $attendant->lastname or '' }}" name="lastname" type="text" required="true" minlength="2"/>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-md-8 center">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Endereço</h4>
                    </div>
                    <div class="card-body ">                    
                        <div id="group-location" class="group center">
                            <div class="form-group has-label">
                                <label>
                                    CEP
                                </label>
                                <input id="input_cep" value="{{ $attendant->cep or '' }}" class="form-control" name="cep" type="text" required="true" onkeyup="mascara('#####-###',this,event)" minlength="9" maxlength="9"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Rua
                                </label>
                                <input id="input_rua" value="{{ $attendant->street or '' }}" class="form-control" name="street" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Número
                                </label>
                                <input class="form-control" value="{{ $attendant->number or '' }}" name="number" type="text" required="true" minlength="1"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Bairro
                                </label>
                                <input id="input_bairro" value="{{ $attendant->district or '' }}" class="form-control" name="district" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Estado
                                </label>
                                <input id="input_estado" value="{{ $attendant->state or '' }}" class="form-control" name="state" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Cidade
                                </label>
                                <input id="input_cidade" value="{{ $attendant->city or '' }}" class="form-control" name="city" type="text" required="true" minlength="2"/>
                            </div>
                        </div>                             
                    </div>
                </div>
            </div>
            <div class="col-md-8 center">    
                <div class="card contact">                  
                    <div class="card-header">
                        <h4 class="card-title">Contatos</h4>
                    </div>                
                    <div class="card-body">    
                        <div id="group_contacts" class="group center">
                            <div class="form-group has-label">
                                <label>
                                    Celular
                                </label>
                                <input class="form-control" value="{{ $attendant->cellphone or '' }}" name="cellphone" type="text" required="true" onkeyup="mascara('(##) #####-####',this,event)"  minlength='15' maxlength='15'/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Telefone (Fixo)
                                </label>
                                <input class="form-control" value="{{ $attendant->phone or '' }}" name="phone" type="text" required="true" onkeyup="mascara('(##) ####-####',this,event)"  minlength='14' maxlength='14'/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    E-mail
                                </label>
                                <input class="form-control" value="{{ $attendant->email or '' }}" name="email" type="email" required="true"/>
                            </div>
                        </div>      
                         
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
    </form>
</div>
@endsection

@section('scripts')
<script src="/cdn/jquery/jquery.validate.min.js"></script>
<script src="/cdn/mascara_js/mascara.min.js"></script>
<script src="/js/pages/attendant_new.js"></script>
@endsection