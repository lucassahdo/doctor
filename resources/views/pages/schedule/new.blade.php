@extends('layout.base') 

@section('styles')
<link rel="stylesheet" href="/css/pages/schedule_new.css"/>
@endsection

@section('content')
<div class="panel-header panel-header-sm">
</div>

<div class="content">
    @php 
        $form_action = isset($schedule) ? "/schedule/update/$schedule->id" : "/schedule/create";        
    @endphp
    <form id="form_schedule" method="post" action="{{ $form_action }}" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 center">    
                <div class="card pessoa">
                    <div class="card-header">
                        <h4 class="card-title">Dados Gerais</h4>
                    </div>
                    <div class="card-body">                           
                        <div class="group center">
                            <div class="form-group has-label">
                                <label>
                                    Objetivo
                                </label>
                                <input class="form-control" value="{{ $schedule->purpose or '' }}" name="purpose" type="text" required="true" minlength="2"/>
                            </div>
                            <div class="form-group has-label">
                                <label>
                                    Detalhes
                                </label>
                                <input class="form-control" value="{{ $schedule->details or '' }}" name="details" type="text" required="true" minlength="2"/>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-md-8 center">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Médico</h4>
                            </div>
                            <div class="card-body ">
                                <div class="select-wrapper center">
                                    <select id="doctor-select" class="selectpicker center" data-size="7" data-live-search="true" data-style="btn btn-primary btn-round" title="Selecionar">
                                        <option class="option-new" value='/doctor/new'>                                            
                                            + Novo
                                        </option>           
                                        <optgroup label="Médicos">
                                            @foreach($doctors as $doctor)
                                                @if (isset($schedule) && $schedule->doctor == $doctor->id)
                                                    <option value='{{ $doctor->id }}' selected>
                                                        Dr(a). {{ $doctor->name . ' ' . $doctor->lastname }}
                                                    </option>   
                                                @else
                                                    <option value='{{ $doctor->id }}'>
                                                        Dr(a). {{ $doctor->name . ' ' . $doctor->lastname }}
                                                    </option>
                                                @endif 
                                            @endforeach
                                        </optgroup>                                                         
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Paciente</h4>
                            </div>
                            <div class="card-body ">
                                <div class="select-wrapper center">  
                                    <select id="patient-select"  class="selectpicker center" data-size="7" data-live-search="true" data-style="btn btn-primary btn-round" title="Selecionar">                             
                                        <option class="option-new" value='/patient/new'>                                            
                                            + Novo
                                        </option>           
                                        <optgroup label="Pacientes"> 
                                            @foreach($patients as $patient)   
                                                @if (isset($schedule) && $schedule->patient == $patient->id)                       
                                                    <option value='{{ $patient->id }}' selected>
                                                        {{ $patient->name . ' ' . $patient->lastname }}
                                                    </option>    
                                                @else
                                                    <option value='{{ $patient->id }}'>
                                                        {{ $patient->name . ' ' . $patient->lastname }}
                                                    </option>   
                                                @endif
                                            @endforeach
                                        </optgroup>                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 center">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Dia</h4>
                            </div>
                            <div class="card-body ">
                                <div class="form-group">
                                    @php
                                        $today = date("d/m/y"); 
                                        $date = isset($schedule->date) ? (new DateTime($schedule->date))->format('d/m/Y') : $today;
                                    @endphp
                                    <input type="text" name="date" class="form-control datepicker" value="{{ $date }}" onkeyup="mascara('##/##/####',this,event)" minlength="10" maxlength="10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Hora</h4>
                            </div>
                            <div class="card-body ">
                                <div class="form-group">
                                    @php
                                        $now = date("H:i"); 
                                        $time = isset($schedule->time) ? $schedule->time : $now;
                                    @endphp
                                    <input type="text" name="time" class="form-control timepicker" value="{{ $time }}">
                                </div>
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
<script src="/js/pages/schedule_new.js"></script>
@endsection