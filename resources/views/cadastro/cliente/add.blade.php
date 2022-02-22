@extends('layouts.admin')

@section('content')

<div id="espera" style='background-color: #fff; opacity: 80%; width: 100%; height: 100%; position: fixed;z-index: 1; display:none;'>
<div class="justify-content-center" style= 'margin-top: 8%; margin-left: 20%;'>
    <img src="{{ asset('consImages/LOCARMAISLOOPING.gif') }}" alt="LocarMais" class="brand-image">
    Aguarde Enquanto encontramos seu cliente
</div>
</div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('cruds.contrato.title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contratoCliente') }}">@lang('cruds.contrato.title')</a></li>
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        
        <div class="col-lg-10 offset-lg-1 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0"><b>@lang('global.add') Cliente</b></h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('contratoCreate') }}" method="post" id='cliente'>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cruds.contrato.fields.cpf')</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control cpf {{ $errors->has('cpf') ? "is-invalid":"" }}" value="{{ old('cpf') }}" onBlur="toggle_api_spc()" required>
                                    @if($errors->has('cpf'))
                                        <span class="error invalid-feedback">{{ $errors->first('cpf') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('cruds.contrato.fields.data_nascimento')</label>
                                    <input type="date" name="data_nasc" id="data_nasc" class="form-control {{ $errors->has('data_nasc') ? "is-invalid":"" }}" value="{{ old('data_nasc') }}" required>
                                    @if($errors->has('data_nasc'))
                                        <span class="error invalid-feedback">{{ $errors->first('data_nasc') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('cruds.contrato.fields.telefone')</label>
                                    <input type="text" name="telefone"id="telefone" class="form-control telefone {{ $errors->has('telefone') ? "is-invalid":"" }}" value="{{ old('telefone') }}" required>
                                    @if($errors->has('telefone'))
                                        <span class="error invalid-feedback">{{ $errors->first('telefone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cruds.contrato.fields.nome')</label>
                                    <input type="text" name="nome" id="nome" class="form-control {{ $errors->has('nome') ? "is-invalid":"" }}" value="{{ old('nome') }}" required>
                                    @if($errors->has('nome'))
                                        <span class="error invalid-feedback">{{ $errors->first('nome') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('cruds.contrato.fields.email')</label>
                                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? "is-invalid":"" }}" value="{{ old('email') }}" required>
                                    @if($errors->has('email'))
                                        <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('cruds.contrato.fields.tefone_contato')</label>
                                    <input type="text" name="telefone_contato" id="telefone_contato" class="form-control telefone {{ $errors->has('tefone_contato') ? "is-invalid":"" }}" value="{{ old('tefone_contato') }}" required>
                                    @if($errors->has('tefone_contato'))
                                        <span class="error invalid-feedback">{{ $errors->first('tefone_contato') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                            <a href="{{ route('userIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        
    </section>

@endsection

@section('scripts')
    <script>
        function toggle_api_spc(){
            cpf= document.getElementById("cpf").value;
            if(cpf){
                document.getElementById("espera").style.display = "block";
                $.ajax({
                    url: "/api/api-spc/consulta/"+cpf,
                    type: "POST",
                    data:{
                        _token: '{!! auth()->user()->password !!}'
                    },
                    dataType: "JSON",
                    success: function(result){
                        console.log(result)
                        if (result){
                            document.getElementById("espera").style.display = "none";
                            $('#nome').val(result.nome);
                            $('#data_nasc').val(result.nascimento);
                            $('#email').val(result.email);
                            $('#telefone').val(result.telefone);
                            $('#telefone_contato').val(result.telefone_contato);
                        }
                    },
                    error: function (errorMessage){
                        alert('Ops! Não conseguimos achar esse Cliente :(');
                        document.getElementById("espera").style.display = "none";
                        document.getElementById('cliente').reset();
                        console.log(errorMessage)
                    }
                });
            }
        }
    </script>
@endsection

