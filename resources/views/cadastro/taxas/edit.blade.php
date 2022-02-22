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
                        <li class="breadcrumb-item"><a href="{{ route('api-userIndex') }}">@lang('cruds.taxa.title')</a></li>
                        <li class="breadcrumb-item active">@lang('global.edit')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.edit')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('taxaUpdate',$taxa->id) }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label>@lang('cruds.taxa.fields.name')</label>
                                <input type="text" name="nome" class="form-control {{ $errors->has('nome') ? "is-invalid":"" }}" value="{{ old('nome', $taxa->nome) }}" required>
                                @if($errors->has('nome'))
                                    <span class="error invalid-feedback">{{ $errors->first('nome') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('cruds.taxa.fields.valor')</label>
                                <input type="number" name="valor"  class="form-control {{ $errors->has('valor') ? "is-invalid":"" }}" value="{{ old('valor', $taxa->valor) }}" step="0.01" required>
                                @if($errors->has('valor'))
                                    <span class="error invalid-feedback">{{ $errors->first('valor') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('cruds.taxa.fields.comissao')</label>
                                <input type="number" name="comissao"  class="form-control {{ $errors->has('comissao') ? "is-invalid":"" }}" value="{{ old('comissao', $taxa->comissao) }}" step="0.01" required>
                
                                @if($errors->has('comissao'))
                                    <span class="error invalid-feedback">{{ $errors->first('comissao') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('cruds.taxa.fields.parcelas')</label>
                                <input type="number" name="parcelas"  class="form-control {{ $errors->has('parcelas') ? "is-invalid":"" }}" value="{{ old('parcelas', $taxa->parcelas) }}" required>
                
                                @if($errors->has('parcelas'))
                                    <span class="error invalid-feedback">{{ $errors->first('parcelas') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('userIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
