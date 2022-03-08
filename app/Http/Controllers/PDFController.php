<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Dompdf\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Http\Controllers\Api\ApiSpcController;

class PDFController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Teste Pretinha',
            'date' => date('m/d/Y')
        ];
        
       
        $pdf = PDF::loadView('myPDF', $data);
        $pdf->save(storage_path('dossie/teste.pdf'));
 
    
        //return $pdf->download('laratutorials.pdf');
        return $pdf->stream();
    }

    public function dossie($resultado)
    {
        
        $result= json_decode(ApiSpcController::ler('dossie/'.$resultado));

        $qtd= $result->spc->resumo->{'quantidade-total'};
        if($qtd > 1){
            for($i= 0; $i< $qtd; $i ++ ){ 
                @$spc.= '<tr>
                            <td><b>Nome Associado:</b>'.@$result->spc->{'detalhe-spc'}[$i]->{'nome-associado'}.'</td>
                        </tr>
                        <tr>
                            <td><b>Data Vencimento:</b> '.@$result->spc->{'detalhe-spc'}[$i]->{'data-inclusao'}.' | <b>Data Inclusão:</b> '.@$result->spc->{'detalhe-spc'}[$i]->{'data-vencimento'}.'</td>
                        </tr>
                        <tr>
                            <td><b>Entidade:</b> '.@$result->spc->{'detalhe-spc'}[$i]->{'nome-entidade'}.'</td>
                        </tr>
                        <tr>
                            <td><b>Contrato:</b> '.@$result->spc->{'detalhe-spc'}[$i]->contrato.' </td>
                        </tr>
                        <tr>
                            <td><b>Comprador/Fiador/Avalista:</b>'.@$result->spc->{'detalhe-spc'}[$i]->{'comprador-fiador-avalista'}.' | <b>Valor:</b>'.number_format(@$result->spc->{'detalhe-spc'}[$i]->valor, 2, ',', '.').'</td>
                        </tr><br><hr>';
            } 
        }elseif($qtd == 1){  
            @$spc.= '<tr>
                        <td><b>Nome Associado:</b>'.@$result->spc->{'detalhe-spc'}->{'nome-associado'}.'</td>
                    </tr>
                    <tr>
                        <td><b>Data Vencimento:</b> '.@$result->spc->{'detalhe-spc'}->{'data-inclusao'}.' | <b>Data Inclusão:</b> '.@$result->spc->{'detalhe-spc'}->{'data-vencimento'}.'</td>
                    </tr>
                    <tr>
                        <td><b>Entidade:</b> '.@$result->spc->{'detalhe-spc'}->{'nome-entidade'}.'</td>
                    </tr>
                    <tr>
                        <td><b>Contrato:</b> '.@$result->spc->{'detalhe-spc'}->contrato.' </td>
                    </tr>
                    <tr>
                        <td><b>Comprador/Fiador/Avalista:</b>'.@$result->spc->{'detalhe-spc'}->{'comprador-fiador-avalista'}.' | <b>Valor:</b>'.number_format(@$result->spc->{'detalhe-spc'}->valor, 2, ',', '.').'</td>
                    </tr><br><hr>';
        }else{
            @$spc='<tr>
                    <td>NADA CONSTA</td>
                </tr>';
        }

        //passa pelo array de cheques
        
        $qtdc= $result->{'cheque-lojista'}->resumo->{'quantidade-total'};
        if($qtdc){
            for($i= 0; $i< $qtdc; $i ++ ){ 
                @$cheque.= '<tr>
                                <td><b>Banco:</b>'.@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->{'cheque-inicial'}->{'dados-bancarios'}->{'numero-agencia'}.' - '.@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->{'cheque-inicial'}->{'dados-bancarios'}->banco->nome.'</td>
                            </tr>
                            <tr>
                                <td><b>Data Emissão:</b> '.@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->{'cheque-inicial'}->{'data-emissao'}.'</td>
                            </tr>
                            <tr>
                                <td><b>Cheque:</b> '.@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->{'cheque-inicial'}->numero.' - '.@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->{'cheque-inicial'}->digito.' | <b>Valor:</b> '.number_format(@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->{'cheque-inicial'}->valor, 2, ',', '.').' | <b>Motivo:</b> '.@$result->{'cheque-lojista'}->{'detalhe-cheque-lojista'}->alinea->descricao.'</td>
                            </tr>
                            <br><hr>';
            } 
        }else{  
            $cheque='<tr>
                        <td>NADA CONSTA</td>
                    </tr>';
        }


        //passa pelo array de ccf
        if($result->ccf->resumo->{'quantidade-total'} >0){
            $ccf='<tr>
                    <td><b>Motivo:</b>'.@$result->ccf->{'detalhe-ccf'}->motivo->descricao.' | <b>Quantidade:</b> '.@$result->ccf->resumo->{'quantidade-total'}.'</td>
                    </tr>
                    <tr>
                        <td><b>Data Ultimo Cheque:</b> '.@$result->ccf->{'detalhe-ccf'}->{'data-ultimo-cheque'}.' | <b>Origem:</b> '.@$result->ccf->{'detalhe-ccf'}->origem.'</td>
                    </tr>
                ';
        }else{
            $ccf='<tr>
                    <td>NADA CONSTA</td>
                </tr>';
        }

                //passa pelo array de tds as consultas feitas do spc
        $qtds= @$result->{'consulta-realizada'}->resumo->{'quantidade-total'};
        if($qtds > 1){
            for($i= 0; $i< $qtds; $i ++ ){ 
                @$consultas.= '<tr>
                            <td><b>Nome Associado:</b>'.@$result->{'consulta-realizada'}->{'detalhe-consulta-realizada'}[$i]->{'nome-associado'}.'</td>
                        </tr>
                        <tr>
                            <td><b>Data Emissão:</b> '.@$result->{'consulta-realizada'}->{'detalhe-consulta-realizada'}[$i]->{'data-consulta'}.'</td>
                        </tr>
                        <tr>
                            <td><b>Origem:</b> '.@$result->{'consulta-realizada'}->{'detalhe-consulta-realizada'}[$i]->{'nome-entidade-origem'}.'</td>
                        </tr>
                        <br><hr>';
            }
        }elseif($qtds == 1){  
            @$consultas.= '<tr>
                        <td><b>Nome Associado:</b>'.@$result->{'consulta-realizada'}->{'detalhe-consulta-realizada'}->{'nome-associado'}.'</td>
                    </tr>
                    <tr>
                        <td><b>Data Emissão:</b> '.@$result->{'consulta-realizada'}->{'detalhe-consulta-realizada'}->{'data-consulta'}.'</td>
                    </tr>
                    <tr>
                        <td><b>Origem:</b> '.@$result->{'consulta-realizada'}->{'detalhe-consulta-realizada'}->{'nome-entidade-origem'}.'</td>
                    </tr><br><hr>';
        }else{  
        @$consultas.='<tr>
                        <td>NADA CONSTA</td>
                    </tr>';
        }

        //array de alerta de documentos
        $alerta = null;
        if($result->{'alerta-documento'}->resumo->{'quantidade-total'}){
        $qtdA=$result->{'alerta-documento'}->resumo->{'quantidade-total'};
        for($j= 0; $j< $qtdA; $j ++){
            @$qtdDetalhe=count($result->{'alerta-documento'}->{'detalhe-alerta-documento'});
            $alerta.='<tr>
                        <td><b>Data Ocorrencia:</b>'.@$result->{'alerta-documento'}->{'detalhe-alerta-documento'}->{'data-ocorrencia'}.' | <b>Data Inclusao:</b>'.@$result->{'alerta-documento'}->{'detalhe-alerta-documento'}->{'data-inclusao'}.'</td>
                        </tr>
                        <tr>
                            <td><b>Motivo:</b>'.@$result->{'alerta-documento'}->{'detalhe-alerta-documento'}->motivo.'</td>
                        </tr>
                        ';
                $foreach=$result->{'alerta-documento'}->{'detalhe-alerta-documento'};
                foreach($foreach  as $v){ 
                    if(isset($v->nome)){
                        $alerta.= '<tr>
                                <td><b>Documento:</b>'.$v->nome.'</td>
                            </tr>
                            ';
                    }
                } 
            
            $alerta.='<br><hr>'; 
            
        }

        }else{
            $alerta .='<tr>
            <td>NADA CONSTA</td>
            </tr>';
        }

        $data = [
            'result' => $result,
            'spc'    =>$spc,
            'cheque'=>$cheque,
            'ccf'   =>$ccf,
            'consultas'=> $consultas,
            'alerta' => $alerta,
            'date' => date('m/d/Y')
        ];
             
        $pdf = PDF::loadView('dossie', $data);

        //return $pdf->download('laratutorials.pdf');
        return $pdf->stream();
    }
}
