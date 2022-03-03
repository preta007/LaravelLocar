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
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Settings</a>
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
                                    <td><span style='float: left;'>{{ $contrato->cliente->score }}</span> <button type="button" class="btn btn-block btn-primary btn-xs" style='width: 80%; margin-left: 10%; '> clique e veja o dossie </button></td>
                                </tr>
                            @endcan
                        </tbody>
                    </table>
                </div>
                  <div class="tab-pane fade" id="vert-tabs-coinquilino" role="tabpanel" aria-labelledby="vert-tabs-coinquilino-tab">
                  <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td><a href="{{ route('contratoCoinquilino', ['id' => $contrato->id, 'tipo'=>'participativo']) }}" class="btn btn-block btn-primary btn-xs" style='width: 80%; margin-left: 10%; '>Adicionar coinquilino participativo</button></td>
                                <td><a href="{{ route('contratoCliente') }}" class="btn btn-block btn-primary btn-xs" style='width: 80%; margin-left: 10%; '>Adicionar coinquilino titular cartão</button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
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

