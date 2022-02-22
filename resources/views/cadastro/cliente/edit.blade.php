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
                        <li class="breadcrumb-item"><a href="{{ route('api-userIndex') }}">@lang('cruds.plano.title')</a></li>
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

                        <form action="{{ route('planoUpdate',$plano->id) }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label>@lang('cruds.plano.fields.name')</label>
                                <input type="text" name="nome" class="form-control {{ $errors->has('nome') ? "is-invalid":"" }}" value="{{ old('nome', $plano->nome) }}" required>
                                @if($errors->has('nome'))
                                    <span class="error invalid-feedback">{{ $errors->first('nome') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('cruds.plano.fields.percentage')</label>
                                <input type="number" name="percentual"  class="form-control {{ $errors->has('percentual') ? "is-invalid":"" }}" value="{{ old('percentual', $plano->percentual) }}" step="0.01" required>
                                @if($errors->has('percentual'))
                                    <span class="error invalid-feedback">{{ $errors->first('percentual') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('cruds.plano.fields.limit')</label>
                                <input type="number" name="limite"  class="form-control {{ $errors->has('limite') ? "is-invalid":"" }}" value="{{ old('limite', $plano->limite) }}" step="0.01"  required>
                
                                @if($errors->has('limite'))
                                    <span class="error invalid-feedback">{{ $errors->first('limite') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('planoIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
