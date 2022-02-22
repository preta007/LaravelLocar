@extends('layouts.admin')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@lang('panel.gestao.title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                            <li class="breadcrumb-item active">@lang('cruds.plano.title')</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
  
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('panel.gestao.contrato')</h3>
                            @can('plano.add')
                            <a href="{{ route('planoAdd') }}" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                            @endcan
                        </div>
                        <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>@lang('panel.gestao.id')</th>
                    <th>@lang('panel.gestao.nome')</th>
                    <th>@lang('panel.gestao.aluguel')</th>
                    <th>@lang('panel.gestao.telefone')</th>
                    <th>@lang('panel.gestao.registro')</th>
                    <th>@lang('panel.gestao.pagamento')</th>
                    <th>@lang('panel.gestao.status')</th>
                    <th>@lang('panel.gestao.acao')</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($contratos as $contrato)
                        <tr>
                            <td>{{ $contrato->id }}</td>
                            <td>{{ $contrato->cliente->nome }}</td>
                            <td>{{ $contrato->valor_locaticio }}</td>
                            <td>{{ $contrato->cliente->telefone }}</td>
                            <td>{{ date('d-m-Y H:i', strtotime($contrato->created_at)) }}</td>
                            <td>{{ date('d-m-Y H:i', strtotime($contrato->created_at)) }}</td>
                            <td>
                                @if($contrato->status =='Aprovado') 
                                    <button type="button" class="btn btn-block btn-success">{{ $contrato->status }}</button>
                                @elseif($contrato->status =='Reprovado' || $contrato->status =='Mesa de Análise')
                                    <button type="button" class="btn btn-block btn-danger">{{ $contrato->status }}</button> 
                                @else 
                                    <button type="button" class="btn btn-block btn-warning">{{ $contrato->status }}</button>  
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('contratoShow',$contrato->id) }}" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('planoAdd') }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-pen"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                  
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection
@section('scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "order": [[ 3, "desc" ]],
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
