@php 
    $data = isset($person['attributes']) ? $person['attributes'] : []; 
    $person_type = isset($person_type) ? $person_type : 'default';
@endphp

@extends('layout.base') 

@section('styles')
<link rel="stylesheet" href="/css/pages/person_new.css"/>
@endsection

@section('content')
<div class="panel-header panel-header-sm">
</div>

<div class="content">
    @php 
        $form_action = '';
        if (isset($person)) {
            if ($person_type == 'natural')
                $form_action = "/person/update/natural/{$data['id']}";
            if ($person_type == 'legal')
                $form_action = "/person/update/legal/{$data['id']}";
        }
        else {
            $form_action = "/person/create";
        }
    @endphp
    <form id="form_person" method="post" action="{{ $form_action }}" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 center">    
                <div class="card pessoa">
                    <div class="card-header">
                        <h4 class="card-title">Pessoa</h4>
                    </div>
                    <div class="card-body">  
                        @if (isset($person))
                            <div class="select-wrapper center">                   
                                <select class="selectpicker center" data-size="7" data-style="btn btn-primary btn-round" disabled>                             
                                    @if ($person_type == 'legal')
                                        <option value='group_pfisica'>Física</option>
                                        <option value='group_pjuridica' selected>Jurídica</option>
                                    @elseif ($person_type == 'natural')
                                        <option value='group_pfisica' selected>Física</option>
                                        <option value='group_pjuridica'>Jurídica</option>
                                    @endif
                                </select>
                            </div>                                           

                            @if ($person_type == 'natural')
                                <div id="group_pfisica" class="group center">
                                    <div class="form-group has-label">
                                        <label>
                                            CPF
                                        </label>
                                        <input class="form-control" value="{{ $data['cpf'] or '' }}" name="cpf" type="text" required="true" onkeyup="mascara('###.###.###-##',this,event)" maxlength="14" minlength="14"/>
                                    </div>
                                    <div class="form-group has-label">
                                        <label>
                                            Nome
                                        </label>
                                        <input class="form-control" value="{{ $data['nome'] or '' }}" name="nome" type="text" required="true"/>
                                    </div>
                                </div>
                            @endif

                            @if ($person_type == 'legal')
                                <div id="group_pjuridica" class="group center">
                                    <div class="form-group has-label">
                                        <label>
                                            CNPJ
                                        </label>
                                        <input class="form-control" value="{{ $data['cnpj'] or '' }}" name="cnpj" type="text" required="true" onkeyup="mascara('##.###.###/####-##',this,event)" minlength="18" maxlength="18"/>
                                    </div>
                                    <div class="form-group has-label">
                                        <label>
                                            Razão Social
                                        </label>
                                        <input class="form-control" value="{{ $data['razao_social'] or '' }}" name="razao_social" type="text" required="true" minlength="2"/>
                                    </div>
                                    <div class="form-group has-label">
                                        <label>
                                            Nome Fantasia
                                        </label>
                                        <input class="form-control" value="{{ $data['nome_fantasia'] or '' }}" name="nome_fantasia" type="text" required="true" minlength="2"/>
                                    </div>
                                </div> 
                            @endif
                        @else
                            <div class="select-wrapper center">                   
                                <select class="selectpicker center" data-size="7" data-style="btn btn-primary btn-round" title="Selecionar">                             
                                    <option value='group_pfisica'>Física</option>
                                    <option value='group_pjuridica'>Jurídica</option>
                                </select>
                            </div>

                            <div class="group center text-center" style="padding: 20px 3px; font-weight: 400;">
                                <span>Nenhuma opção escolhida</span>                      
                            </div>                                           

                            <div id="group_pfisica" class="group center" style="display:none">
                                <div class="form-group has-label">
                                    <label>
                                        CPF
                                    </label>
                                    <input class="form-control" name="cpf" type="text" required="true" onkeyup="mascara('###.###.###-##',this,event)" maxlength="14" minlength="14"/>
                                </div>
                                <div class="form-group has-label">
                                    <label>
                                        Nome
                                    </label>
                                    <input class="form-control" name="nome" type="text" required="true"/>
                                </div>
                            </div>
                            
                            <div id="group_pjuridica" class="group center" style="display:none">
                                <div class="form-group has-label">
                                    <label>
                                        CNPJ
                                    </label>
                                    <input class="form-control" name="cnpj" type="text" required="true" onkeyup="mascara('##.###.###/####-##',this,event)" minlength="18" maxlength="18"/>
                                </div>
                                <div class="form-group has-label">
                                    <label>
                                        Razão Social
                                    </label>
                                    <input class="form-control" name="razao_social" type="text" required="true" minlength="2"/>
                                </div>
                                <div class="form-group has-label">
                                    <label>
                                        Nome Fantasia
                                    </label>
                                    <input class="form-control" name="nome_fantasia" type="text" required="true" minlength="2"/>
                                </div>
                            </div>  
                        @endif          
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
                                <input id="input_cep" value="{{ $data['cep'] or '' }}" class="form-control" name="cep" type="text" required="true" onkeyup="mascara('#####-###',this,event)" minlength="9" maxlength="9"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Rua
                                </label>
                                <input id="input_rua" value="{{ $data['rua'] or '' }}" class="form-control" name="rua" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Número
                                </label>
                                <input class="form-control" value="{{ $data['numero'] or '' }}" name="numero" type="text" required="true" minlength="1"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Bairro
                                </label>
                                <input id="input_bairro" value="{{ $data['bairro'] or '' }}" class="form-control" name="bairro" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Estado
                                </label>
                                <input id="input_estado" value="{{ $data['estado'] or '' }}" class="form-control" name="estado" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Cidade
                                </label>
                                <input id="input_cidade" value="{{ $data['cidade'] or '' }}" class="form-control" name="cidade" type="text" required="true" minlength="2"/>
                            </div>
                        </div>                             
                    </div>
                </div>
            </div>
            <div class="col-md-8 center">    
                <div class="card contact">
                    @if (isset($person))       
                        <div class="card-header">
                            <h4 class="card-title">Contatos</h4>
                        </div>
                    @else
                        <div class="card-header" style="display:none">
                            <h4 class="card-title">Contatos</h4>
                        </div>
                    @endif
                    <div class="card-body">      
                        @if (isset($person))                      
                            <div id="group_contacts" class="group center">
                                <div class="form-group has-label">
                                    <label>
                                        Telefone
                                    </label>
                                    <input class="form-control" value="{{ $data['telefone'] or '' }}" name="telefone" type="text" required="true" onkeyup="mascara('(##) ####-####',this,event)" minlength='14' maxlength='14'/>
                                </div>
                                <div class="form-group has-label">
                                    <label>
                                        E-mail
                                    </label>
                                    <input class="form-control" value="{{ $data['email'] or '' }}" name="email" type="email" required="true"/>
                                </div>
                            </div>      
                        @else         
                            <button id="add-contact" class="btn btn-primary btn-round">
                                <i class="now-ui-icons ui-1_simple-add"></i>
                                Adicionar Contatos
                            </button>                        
                            <div id="group_contacts" class="group center" style="display:none">
                                <div class="form-group has-label">
                                    <label>
                                        Telefone
                                    </label>
                                    <input class="form-control" name="telefone" type="text" required="true" onkeyup="mascara('(##) ####-####',this,event)"  minlength='14' maxlength='14'/>
                                </div>
                                <div class="form-group has-label">
                                    <label>
                                        E-mail
                                    </label>
                                    <input class="form-control" name="email" type="email" required="true"/>
                                </div>

                                <button id="delete-contact" class="btn btn-primary btn-round">
                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                    Remover
                                </button>
                            </div>      
                        @endif   
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
<script src="/js/pages/person_new.js"></script>
@endsection