@extends('layout.base') 

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-4 col-sm-4">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="statistics statistics-horizontal">
                        <div class="info info-horizontal">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon icon-primary icon-circle">
                                        <i class="now-ui-icons business_chart-bar-32"></i>
                                    </div>
                                </div>
                                <div class="col-7 text-right">
                                    <h3 class="info-title">{{ $appoint_count or '0' }}</h3>
                                    <h6 class="stats-title">Consultas Totais</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="statistics statistics-horizontal">
                        <div class="info info-horizontal">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon icon-warning icon-circle">
                                        <i class="now-ui-icons ui-1_bell-53"></i>
                                    </div>
                                </div>
                                <div class="col-7 text-right">
                                    <h3 class="info-title">{{ $appoint_pending or '0' }}</h3>
                                    <h6 class="stats-title">Consultas Pendentes</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="statistics statistics-horizontal">
                        <div class="info info-horizontal">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon icon-danger icon-circle">
                                        <i class="now-ui-icons tech_watch-time"></i>
                                    </div>
                                </div>
                                <div class="col-7 text-right">
                                    <h3 class="info-title">{{ $appoint_today or '0' }}</h3>
                                    <h6 class="stats-title">Consultas para hoje</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Próximas Consultas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Doutor  
                                </th>
                                <th>
                                    Paciente
                                </th>
                                <th>
                                    Dia
                                </th>
                                <th>
                                    Hora
                                </th>
                                <th class="text-right">
                                    Tipo de consulta
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $item)
                                    <tr>
                                        <td>
                                            {{ $item['doctor']['name'] . ' ' . $item['doctor']['lastname']}}
                                        </td>
                                        <td>
                                            {{ $item['patient']['name'] . ' ' . $item['patient']['lastname'] }}
                                        </td>
                                        <td>
                                            {{ $item['date'] }}
                                        </td>
                                        <td>
                                            {{ $item['time'] }}
                                        </td>
                                        <td class="text-right">
                                            {{ $item['name'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection