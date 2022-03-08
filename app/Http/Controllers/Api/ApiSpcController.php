<?php

namespace App\Http\Controllers\Api;

use SoapClient;
use App\Http\Controllers\PDFController;


class ApiSpcController
{
    public function consultaCpf($data)
    {
        $wsdl = "https://treina.spc.org.br/spc/remoting/ws/consulta/consultaWebService?wsdl";
        $location = "https://treina.spc.org.br/spc/remoting/ws/consulta/consultaWebService";

        $user = '4085931';
        $pass = 'temp@123';
 
        $context = [
            'http' =>
             [
                 'header' =>[ 
                    'Cookie: $Version=0; JSESESIONID=48g39p406ezh_dev01; $Path=/spc',
                    'Authorization: Basic '.'d3N0ZXN0ZTp3c3Rlc3RlMzMz',
                     'Content-Lenght: 337',
                     'SOAPAction: ""',
                     'User-Agent: Jakarta Commons-HttpClient/3.0.1',
                     'Content-Type: text/xml;charset=UTF-8',
                     'Connection: close'
                 ]
                ]
        ];
        
        // Instancia um cliente SOAP
        $client = new SoapClient($wsdl,array(
            "trace" => 1, // Habilita o trace
            "exceptions" => 1, // Trata as exceções
            "login" => $user,
            "password" => $pass,
            "stream_context"=>stream_context_create($context),
            "location" => $location
        ));

        $codigo_produto = '325';  //SPC IMOBILIÁRIO 
        $codigo_insumo_opcional1 = '5122'; //spc-score-3-meses
        $tipo_consumidor = 'F';
        //$documento_consumidor = @$cpf;
        $documento_consumidor = ApiSpcController::soNumero($data);
        $cep_consumidor = '87025-230'; 
        $result = false;
        $max_retries = 5;
        $retry_count = 0;

        //PARAM FILTRO CONSULTAR
            $params = array(
                array('codigo-produto' => $codigo_produto, 
                    'documento-consumidor'=> $documento_consumidor ,
                    'tipo-consumidor'=> $tipo_consumidor,
                    'cep-consumidor'=> $cep_consumidor,
                    'codigo-insumo-opcional' => array('77','5122')
                    )
            );

            try
            {
                $result = $client->__soapCall('consultar',$params);
            }
            catch(SoapFault $fault)
            {
                if($fault->faultstring != 'Could not connect to host')
                {
                throw $fault;
                }
            }

            //$pdf = PDFController::dossie($result,$documento_consumidor);
            $pdf = ApiSpcController::gravar(json_encode($result),$documento_consumidor );
            
            $dadosCliente['nome']       =$result->consumidor->{'consumidor-pessoa-fisica'}->nome;
            $dadosCliente['nascimento'] =$result->consumidor->{'consumidor-pessoa-fisica'}->{'data-nascimento'};
            $dadosCliente['score']      =$result->{'spc-score-3-meses'}->{'detalhe-spc-score-3-meses'}->score;
            $dadosCliente['renda']      =number_format($result->{'renda-presumida-spc'}->resumo->{'valor-total'}, 2, ".", "");
            $dadosCliente['dossie']     =$pdf;

            return $dadosCliente;

    }

    public function soNumero($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function gravar($texto, $cpf){
        //Variável arquivo armazena o nome e extensão do arquivo.
        $arquivo = storage_path('dossie/'.$cpf.'.txt');
        
        //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
        $fp = fopen($arquivo, "a+");
    
        //Escreve no arquivo aberto.
        fwrite($fp, $texto);
        
        //Fecha o arquivo.
        fclose($fp);

        return $cpf.'.txt';
    }

    function ler($arquivo){
        
        //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
        $fp = fopen(storage_path($arquivo), "r");
    
        //Lê o conteúdo do arquivo aberto.
        $conteudo = fread($fp, filesize(storage_path($arquivo)));
        
        //Fecha o arquivo.
        fclose($fp);
        
        //retorna o conteúdo.
        return $conteudo;
    }

}
