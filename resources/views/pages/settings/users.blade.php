@extends('layout.base') 

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="col-md-12">
    <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Usuários</h4>
                        </div>
                        <div class="col-md-6">
                            <button id="btn-new" class="btn btn-like btn-primary btn-round" style="float:right" onclick="window.location.href='/settings/user/new'">
                                Novo Usuário
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                    </div>
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>E-mail</th>
                                <th>Level</th>
                                <th class="disabled-sorting text-right">Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>N</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>E-mail</th>
                                <th>Level</th>
                                <th class="disabled-sorting text-right">Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
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
<script src="/js/pages/users.js"></script>
@endsection
