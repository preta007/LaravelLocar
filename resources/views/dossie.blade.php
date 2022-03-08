<!DOCTYPE html>
<style>
        @page{margin: 0in 0in 0in 0in;}
        body { 
        background: url('{{public_path('/consImages/TIMBRADO.jpg')}}') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding:20px;
        }
        table{
            margin-top: 8em;
        }
  
    </style>
<html>
    <body>
                <table class="table table-user-information" >
                    <tbody>
                        <tr>
                            <td  style="padding: 10px; border: 1px solid #dddddd; ">Informação Confidencial <br> Uso exclusivo da empresa associada para auxílio na aprovação de crédito. A divulgação de tais informações a terceiros
                            sujeitará o infrator as sanções penais.</td>
                        </tr>
                        <tr>
                            <td style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Consulta</td>
                        </tr>
                        <tr>
                            <td ><b>Protocolo Numero: </b> {{ @$result->protocolo->numero }} | <b>Digito :</b> {{ @$result->protocolo->digito }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Operador Codigo:</b>{{ @$result->operador->codigo}} | <b>Nome :</b> {{ @$result->operador->nome }}
                            </td>
                        </tr>
                        <tr>
                            <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Consumidor</td>
                        </tr>
                        <tr>
                            <td><b>Nome:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->nome }}</td>
                        </tr>
                       
                        <tr>
                            <td><b>RG:</b>{{ @$result->consumidor->{'consumidor-pessoa-fisica'}->{'numero-rg'} }}</td>
                        </tr>
                        <tr>
                            <td><b>Mãe:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->{'nome-mae'} }} </td>
                        </tr>
                        <tr>
                            <td><b>Pai:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->{'nome-pai'} }}</td>
                        </tr>
                        <tr>
                            <td><b>DN:</b>{{ date( 'd/m/Y' , strtotime(@$result->consumidor->{'consumidor-pessoa-fisica'}->{'data-nascimento'})) }}</td>
                        </tr>
                        <tr>
                            <td><b>Estado Civil:</b>{{ @$result->consumidor->{'consumidor-pessoa-fisica'}->{'estado-civil'} }} </td>
                        </tr>
                        <tr>
                            <td><b>Sexo:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->sexo }}</td>
                        </tr>
                        <tr>
                            <td><b>Signo:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->signo }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Dados Residenciais</td>
                        </tr>
                        <tr>
                            <td><b>Endereço/Número:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->endereco->logradouro }} - {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->endereco->numero }}</td>
                        </tr>
                        <tr>
                            <td><b>Bairro:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->endereco->bairro }}</td>
                        </tr>
                        <tr>
                            <td><b>Cidade/UF:</b> {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->endereco->cidade->nome }} - {{ @$result->consumidor->{'consumidor-pessoa-fisica'}->endereco->cidade->estado->{'sigla-uf'} }} </td>
                        </tr>
                        <tr>
                        <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">SPC Score 3 Meses</td>
                    </tr>
                    <tr>
                        <td><b>Segmento Score:</b>{{ @$result->{'spc-score-3-meses'}->{'detalhe-spc-score-3-meses'}->{'segmento-score'} }} | <b>Horizonte:</b>{{ @$result->{'spc-score-3-meses'}->{'detalhe-spc-score-3-meses'}->horizonte }}</td>     
                    </tr>
                    <tr>
                        <td><b>Score:</b> {{ @$result->{'spc-score-3-meses'}->{'detalhe-spc-score-3-meses'}->score }} | <b>Tipo Cliente Score:</b> {{ @$result->{'spc-score-3-meses'}->{'detalhe-spc-score-3-meses'}->{'tipo-cliente-score'} }}</td>     
                    </tr>
                    <tr>
                    <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Renda Presumida</td>
                    </tr>
                    <tr>
                        <td><b>Valor:</b>  {{ number_format(@$result->{'renda-presumida-spc'}->resumo->{'valor-total'}, 2, ',', '.') }}</td>     
                    </tr>
                    <tr>
                            <td style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">SPC</td>
                    </tr>
                        {{ $spc }}
                        <tr>
                            <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Cheque Logista</td>
                        </tr>
                        {{$cheque}}
                        <tr>
                            <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Registro CCF</td>
                        </tr>
                        {{$ccf}}
                        <tr>
                            <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Alerta de Documento</td>
                        </tr>
                        {{$alerta}}
                        <tr>
                            <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Crédito Concedido</td>
                        </tr>
                        <tr>
                            <td><b>Quantidade:</b> {{ @$result->{'credito-concedido'}->resumo->{'quantidade-total'} }} </td>
                            
                        </tr>
                        <tr>
                            <td  style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Consultas Realizadas</td>
                        </tr>
                        {{$consultas}}
                        <tr>
                            <td style="background-color: LavenderBlush; padding: 10px; font-size:20px; text-align: center;">Protesto</td>
                        </tr>
                                            <tr>
                            <td><b>Quantidade:</b>{{ @$result->protesto->resumo->{'quantidade-total'} }}</td>     
                        </tr>
                        <tr>
                            <td><b>Data Primeira Ocorrência:</b>{{  date( 'd/m/Y' , strtotime(@$result->protesto->resumo->{'data-primeira-ocorrencia'})) }}</td>     
                        </tr>
                        <tr>
                            <td><b>Data Última Ocorrência:</b>{{  date( 'd/m/Y' , strtotime(@$result->protesto->resumo->{'data-ultima-ocorrencia'})) }}</td>     
                        </tr>
                        <tr>
                            <td><b>Valor Total:</b>{{ @$result->protesto->resumo->{'valor-total'} }}</td>     
                        </tr>
                        </tbody>
                    </table>

    </body>
</html>