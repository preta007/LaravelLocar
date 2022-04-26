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
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-sm-12">
                <div class="card card-primary card-outline">
          <div class="card-header">
                <div class="ribbon-wrapper ribbon-xl">
                    @if($contrato->status =='Aprovado') 
                        <div class="ribbon bg-success text-xl">
                            {{ $contrato->status }}
                        </div>
                    @elseif($contrato->status =='Reprovado' || $contrato->status =='Mesa de Análise')
                        <div class="ribbon bg-danger text-lg">
                            {{ $contrato->status }}
                        </div>
                    @else  
                        <div class="ribbon bg-warning text-lg">
                            {{ $contrato->status }}
                        </div>   
                    @endif
                </div>
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              <b>CONTRATO - {{ $contrato->id }}</b>
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-contrato-tab" data-toggle="pill" href="#vert-tabs-contrato" role="tab" aria-controls="vert-tabs-contrato" aria-selected="true">Dados da Locação</a>
                  <a class="nav-link" id="vert-tabs-cliente-tab" data-toggle="pill" href="#vert-tabs-cliente" role="tab" aria-controls="vert-tabs-cliente" aria-selected="false">Dados do Inquilino</a>
                  <a class="nav-link" id="vert-tabs-coinquilino-tab" data-toggle="pill" href="#vert-tabs-coinquilino" role="tab" aria-controls="vert-tabs-coinquilino" aria-selected="false">Coninquilino</a>
                  <a class="nav-link" id="vert-tabs-arquivos-tab" data-toggle="pill" href="#vert-tabs-arquivos" role="tab" aria-controls="vert-tabs-arquivos" aria-selected="false">Arquivos</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade active show" id="vert-tabs-contrato" role="tabpanel" aria-labelledby="vert-tabs-contrato-tab">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td style='width: 30%;'><b>Tipo de Imóvel:</b></td>
                                <td>{{ $contrato->tipo_imovel }}</td>
                            </tr>
                            <tr>
                                <td><b>Valor Locatício:</b></td>
                                <td>R$ {{ $contrato->valor_locaticio }}</td>
                            </tr>
                            <tr>
                                <td><b>Nome Serviço:</b></td>
                                <td>{{ $contrato->plano->nome }}</td>
                            </tr>
                            <tr>
                                <td><b>Total Serviço:</b></td>
                                <td>R$ {{ $contrato->valor_plano }} anual</td>
                            </tr>
                            <tr>
                                <td><b>Valor taxa SETUP:</b></td>
                                <td>R$ {{ $contrato->taxa->valor}}  anual</td>
                            </tr>
                            <tr>
                                <td><b>CEP:</b></td>
                                <td>{{ $contrato->cep}}</td>
                            </tr>
                            <tr>
                                <td><b>Endereço/Número:</b></td>
                                <td>{{ $contrato->rua}}-{{ $contrato->numero}}</td>
                            </tr>
                            <tr>
                                <td><b>Bairro:</b></td>
                                <td>{{ $contrato->bairro}}</td>
                            </tr>
                            <tr>
                                <td><b>Cidade/UF:</b></td>
                                <td>{{ $contrato->cidade}}/{{ $contrato->estado}}</td>
                            </tr>
                            <tr>
                                <td><b>Complemento:</b></td>
                                <td>{{ $contrato->complemento}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="vert-tabs-cliente" role="tabpanel" aria-labelledby="vert-tabs-cliente-tab">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td style='width: 30%;'><b>Nome:</b></td>
                                <td>{{ $contrato->cliente->nome }}</td>
                            </tr>
                            <tr>
                                <td><b>CPF:</b></td>
                                <td>{{ $contrato->cliente->cpf }}</td>
                            </tr>
                            <tr>
                                <td><b>Dara Nascimento:</b></td>
                                <td>{{ date( 'd/m/Y' , strtotime($contrato->cliente->data_nasc)) }}</td>
                            </tr>
                            <tr>
                                <td><b>E-mail</b></td>
                                <td>{{ $contrato->cliente->email }}</td>
                            </tr>
                            <tr>
                                <td><b>Telefone:</b></td>
                                <td>{{ $contrato->cliente->telefone }}</td>
                            </tr>
                            <tr>
                                <td><b>Telefone Contato:</b></td>
                                <td>{{ $contrato->cliente->telefone_contato }}</td>
                            </tr>
                            @can('gestao.contrato.score.show')
                                <tr>
                                    <td><b>Score:</b></td>
                                    <td><span style='float: left;'>{{ $contrato->cliente->score }}</span> <a href="{{ route('dossie', ['result' => $contrato->cliente->dossie]) }}" class="btn btn-block btn-primary btn-xs" style='width: 80%; margin-left: 10%; ' target='_tblank'> clique e veja o dossie </button></td>
                                </tr>
                            @endcan
                        </tbody>
                    </table>
                </div>
                  <div class="tab-pane fade" id="vert-tabs-coinquilino" role="tabpanel" aria-labelledby="vert-tabs-coinquilino-tab">
                  <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td colspan=2><a href="{{ route('contratoCoinquilino', ['id' => $contrato->id]) }}" class="btn btn-block btn-primary btn-xs" style='width: 80%; margin-left: 10%; '>Adicionar coinquilino</button></td>
                            </tr>
                            @foreach ($contrato->coinquilino as $cliente)
                                <tr>
                                    <td style='width: 30%;'><b>Nome:</b></td>
                                    <td>{{ $cliente->nome }}</td>
                                </tr>
                                <tr>
                                    <td><b>CPF:</b></td>
                                    <td>{{ $cliente->cpf }}</td>
                                </tr>
                                <tr>
                                    <td><b>Dara Nascimento:</b></td>
                                    <td>{{ date( 'd/m/Y' , strtotime($cliente->data_nasc)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>E-mail</b></td>
                                    <td>{{ $cliente->email }}</td>
                                </tr>
                                <tr>
                                    <td><b>Telefone:</b></td>
                                    <td>{{ $cliente->telefone }}</td>
                                </tr>
                                <tr>
                                    <td><b>Telefone Contato:</b></td>
                                    <td>{{ $cliente->telefone_contato }}</td>
                                </tr>
                                @can('gestao.contrato.score.show')
                                    <tr>
                                        <td><b>Score:</b></td>
                                        <td><span style='float: left;'>{{ $cliente->score }}</span> <a href="{{ route('dossie', ['result' => $cliente->dossie]) }}" class="btn btn-block btn-primary btn-xs" style='width: 80%; margin-left: 10%; ' target='_tblank'> clique e veja o dossie </button></td>
                                    </tr>
                                @endcan
                                <tr>
                                    <td colspan=2 style='background: #f700654d;'></td>
                                </tr>
                               
                            @endforeach


                            
                        </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-arquivos" role="tabpanel" aria-labelledby="vert-tabs-arquivos-tab">
                  
                  <form action="{{ route('uploadContrato') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name='id' value='{{ $contrato->id }}'>
                            <input type="hidden" name='id_cliente' value='{{ $contrato->cliente->id }}'>
                           
                            @if($contrato->status =='Aguardando Fatura do Cartão') 
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" multiple name='fatura'>
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Fatura do Cartão</label>
                                    </div>
                                </div>
                            @endif
                            @if($contrato->status =='Pago') 
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='contrato' >
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Contrato</label>
                                    </div>
                                </div>
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='vistoria' >
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Vistoria</label>
                                    </div>
                                </div>
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='apolice'>
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Apólice</label>
                                    </div>
                                </div>
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='contratoAdm' >
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Contrato Administrativo</label>
                                    </div>
                                </div>
                            @endif
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='rgCpf' >
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">RG E CPF</label>
                                    </div>
                                </div>
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='anexo1'>
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Anexo 1</label>
                                    </div>
                                </div>
                                <div class="form-group col-7 col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name='anexo2' >
                                        <label class="custom-file-label" for="customFile" data-browse="Selecione">Anexo 2</label>
                                    </div>
                                </div>
                            <div class="form-group col-7 col-sm-9">
                                    <button type="submit" class="btn btn-success float-right">@lang('global.send_attachment')</button>
                                    <a href="{{ route('userIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.card -->
        </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
        bsCustomFileInput.init()
        })
      
    </script>
@endsection

