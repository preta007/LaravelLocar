@extends('layouts.admin')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@lang('cruds.plano.title')</h1>
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
                            <h3 class="card-title">@lang('cruds.plano.title_singular')</h3>
                            @can('plano.add')
                            <a href="{{ route('planoAdd') }}" class="btn btn-success btn-sm float-right">
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
                                    <th>@lang('cruds.plano.fields.id')</th>
                                    <th>@lang('cruds.plano.fields.name')</th>
                                    <th>@lang('cruds.plano.fields.percentage')</th>
                                    <th>@lang('cruds.plano.fields.limit')</th>
                                    <th>@lang('cruds.plano.fields.status')</th>
                                    <th class="w-25">@lang('global.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($planos as $plano)
                                    <tr>
                                        <td>{{ $plano->id }}</td>
                                        <td>{{ $plano->nome }}</td>
                                        <td>{{ $plano->percentual }}</td>
                                        <td>{{ $plano->limite }}</td>
                                        <td class="text-center">
                                            <i style="cursor: pointer" id="plano_{{ $plano->id }}" class="fas {{ $plano->ativo ? "fa-check-circle text-success":"fa-times-circle text-danger" }}"
                                               @can('plano.edit') onclick="toggle_api_plano({{ $plano->id }})" @endcan ></i>
                                        </td>
                                        <td class="text-center">
                                            @can('plano.delete')
                                            <form action="{{ route('planoDestroy',$plano->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    @can('plano.edit')
                                                        <a href="{{ route('planoEdit',$plano->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
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
        function toggle_api_plano(id){
            $.ajax({
                url: "/api/api-plano/toggle-status/"+id,
                type: "POST",
                data:{
                    _token: '{!! auth()->user()->password !!}'
                },
                dataType: "JSON",
                success: function(result){
                    if (result.ativo == 1){
                        $('#plano_'+id).attr('class',"fas fa-check-circle text-success");
                    }else{
                        $('#plano_'+id).attr('class',"fas fa-times-circle text-danger");
                    }

                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
@endsection
