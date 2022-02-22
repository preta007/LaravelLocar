@extends('layouts.admin')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@lang('cruds.taxa.title')</h1>
                    </div> 
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                            <li class="breadcrumb-item active">@lang('cruds.taxa.title')</li>
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
                            <h3 class="card-title">@lang('cruds.taxa.title_singular')</h3>
                            @can('taxa.add')
                            <a href="{{ route('taxaAdd') }}" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Data table -->
                            <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" role="grid" aria-describedby="dataTable_info">
                                <thead>
                                <tr>
                                    <th>@lang('cruds.taxa.fields.id')</th>
                                    <th>@lang('cruds.taxa.fields.name')</th>
                                    <th>@lang('cruds.taxa.fields.valor')</th>
                                    <th>@lang('cruds.taxa.fields.parcelas')</th>
                                    <th>@lang('cruds.taxa.fields.comissao')</th>
                                    <th>@lang('cruds.taxa.fields.status')</th>
                                    <th class="w-25">@lang('global.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($taxas as $taxa)
                                    <tr>
                                        <td>{{ $taxa->id }}</td>
                                        <td>{{ $taxa->nome }}</td>
                                        <td>{{ $taxa->valor }}</td>
                                        <td>{{ $taxa->parcelas }}</td>
                                        <td>{{ $taxa->comissao }}</td>
                                        <td class="text-center">
                                            <i style="cursor: pointer" id="taxa_{{ $taxa->id }}" class="fas {{ $taxa->ativo ? "fa-check-circle text-success":"fa-times-circle text-danger" }}"
                                               @can('taxa.edit') onclick="toggle_api_taxa({{ $taxa->id }})" @endcan ></i>
                                        </td>
                                        <td class="text-center">
                                            @can('taxa.delete')
                                            <form action="{{ route('taxaDestroy',$taxa->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    @can('taxa.edit')
                                                        <a href="{{ route('taxaEdit',$taxa->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
                                                    @endcan
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if (confirm('Tem certeza?')) { this.form.submit() } "> @lang('global.delete')</button>
                                                </div>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection
@section('scripts')
    <script>
        function toggle_api_taxa(id){
            $.ajax({
                url: "/api/api-taxa/toggle-status/"+id,
                type: "POST",
                data:{
                    _token: '{!! auth()->user()->password !!}'
                },
                dataType: "JSON",
                success: function(result){
                    if (result.ativo == 1){
                        $('#taxa_'+id).attr('class',"fas fa-check-circle text-success");
                    }else{
                        $('#taxa_'+id).attr('class',"fas fa-times-circle text-danger");
                    }

                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
@endsection
