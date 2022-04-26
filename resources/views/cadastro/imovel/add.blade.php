@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('cruds.contrato.title_imovel')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">@lang('cruds.contrato.title_imovel')</a></li>
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
                    <h5 class="m-0"><b>Cliente</b></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6"><b>Nome:</b> {{ $cliente->nome }}</div>
                        <div class="form-group col-6"><b>Cpf:</b> {{ $cliente->cpf }}</div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-lg-10 offset-lg-1 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0"><b>@lang('global.add') Imovél</b></h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{ route('contratoCreateImovel') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_cliente" value ='{{ $cliente->id }}' >
                        <div class="row">
                            <div class="form-group col-6">
                                <label>@lang('cruds.contrato.fields.tipo_imovel')</label>
                                <select name ='tipo_imovel' class="form-control {{ $errors->has('tipo_imovel') ? "is-invalid":"" }}" required>
                                    <option></option>
                                    <option value='Residencial'>Residencial</option>
                                    <option value='Comercial'>Comercial</option>
                                </select>
                               @if($errors->has('tipo_imovel'))
                                    <span class="error invalid-feedback">{{ $errors->first('tipo_imovel') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-6">
                                <label>@lang('cruds.contrato.fields.cep')</label>
                                <input type="numeric" name="cep" id="cep"  class="form-control cep {{ $errors->has('cep') ? "is-invalid":"" }}" value="{{ old('cep') }}" onblur="pesquisacep(this.value);" required>
                                @if($errors->has('cep'))
                                    <span class="error invalid-feedback">{{ $errors->first('cep') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-9">
                                <label>@lang('cruds.contrato.fields.rua')</label>
                                <input type="text" name="rua" id="rua" class="form-control {{ $errors->has('rua') ? "is-invalid":"" }}" value="{{ old('rua') }}" required>
                                @if($errors->has('rua'))
                                    <span class="error invalid-feedback">{{ $errors->first('rua') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <label>@lang('cruds.contrato.fields.numero')</label>
                                <input type="text" name="numero" class="form-control {{ $errors->has('numero') ? "is-invalid":"" }}" value="{{ old('numero') }}" required>
                                @if($errors->has('numero'))
                                    <span class="error invalid-feedback">{{ $errors->first('numero') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>@lang('cruds.contrato.fields.bairro')</label>
                                <input type="text" name="bairro" id="bairro" class="form-control {{ $errors->has('bairro') ? "is-invalid":"" }}" value="{{ old('bairro') }}" required>
                                @if($errors->has('bairro'))
                                    <span class="error invalid-feedback">{{ $errors->first('bairro') }}</span>
                                @endif
                            </div>
                            <div class=" form-group col-3">
                                <label>@lang('cruds.contrato.fields.cidade')</label>
                                <input type="text" name="cidade" id="cidade" class="form-control {{ $errors->has('cidade') ? "is-invalid":"" }}" value="{{ old('cidade') }}" required>
                                @if($errors->has('cidade'))
                                    <span class="error invalid-feedback">{{ $errors->first('cidade') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <label>@lang('cruds.contrato.fields.estado')</label>
                                <input type="text" name="estado" id="estado" class="form-control {{ $errors->has('estado') ? "is-invalid":"" }}" value="{{ old('estado') }}" required>
                                @if($errors->has('estado'))
                                    <span class="error invalid-feedback">{{ $errors->first('estado') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>@lang('cruds.contrato.fields.complemento')</label>
                                <input type="text" name="complemento" class="form-control {{ $errors->has('complemento') ? "is-invalid":"" }}" value="{{ old('complemento') }}" >
                                @if($errors->has('complemento'))
                                    <span class="error invalid-feedback">{{ $errors->first('complemento') }}</span>
                                @endif
                            </div>
                            <div class=" form-group col-3">
                                <label>@lang('cruds.contrato.fields.valor_locaticio')</label>
                                <input type="text" name="valor_locaticio" class="form-control valor {{ $errors->has('valor_locaticio') ? "is-invalid":"" }}" value="{{ old('valor_locaticio') }}" required>
                                @if($errors->has('valor_locaticio'))
                                    <span class="error invalid-feedback">{{ $errors->first('valor_locaticio') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <label>@lang('cruds.contrato.fields.taxa')</label>
                                <select class="form-control{{ $errors->has('id_taxa') ? "is-invalid":"" }}" name='id_taxa' required>
                                    <option value=''>Selecione</option>
                                    @foreach($taxas as $taxa)
                                        <option value='{{ $taxa->id }}'>{{ $taxa->valor }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_taxa'))
                                    <span class="error invalid-feedback">{{ $errors->first('id_taxa') }}</span>
                                @endif
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
<br>
@endsection

@section('scripts')
    <script>
      function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('estado').value=("");
           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('estado').value=(conteudo.uf);
      
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('estado').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

    </script>
@endsection
