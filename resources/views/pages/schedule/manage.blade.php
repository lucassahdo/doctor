@extends('layout.base') 

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="col-md-12">
    <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Consultas</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                    </div>
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Objetivo</th>
                                <th>Detalhes</th>
                                <th>Médico</th>
                                <th>Paciente</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th class="disabled-sorting text-right">Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>N</th>
                                <th>Objetivo</th>
                                <th>Detalhes</th>
                                <th>Médico</th>
                                <th>Paciente</th>
                                <th>Dia</th>
                                <th>Hora</th>
                                <th class="disabled-sorting text-right">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- 

                            Tradicional way

                            @foreach ($items as $i => $item)                      
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item['purpose'] }}</td>
                                    <td>{{ $item['details'] }}</td>
                                    <td>{{ 'Dr(a). ' . $item['doctor']['name'] . ' ' . $item['doctor']['lastname'] }}</td>           
                                    <td>{{ $item['patient']['name'] . ' ' . $item['patient']['lastname'] }}</td>   
                                    <td>{{ $item['date'] }}</td>      
                                    <td>{{ $item['time'] }}</td>                        
                                    <td class="actions text-right">
                                        <a href="/person/edit/legal/{{ $item['id'] }}" class="btn btn-round btn-warning btn-icon btn-sm edit">
                                            <i class="fas fa-edit"></i>                                        
                                        </a>
                                        <a href="/person/delete/legal/{{ $item['id'] }}" class="btn btn-round btn-danger btn-icon btn-sm remove">
                                            <i class="fas fa-minus"></i>                                        
                                        </a>
                                    </td>       
                                </tr>                     
                            @endforeach 
                            
                            -->
                        </tbody>
                    </table>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>
@endsection

@section('scripts')
<script src="/cdn/jquery/jquery.dataTables.min.js"></script>
<script src="/js/pages/schedule_manage.js"></script>
@endsection
