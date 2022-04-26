<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Taxa;
use App\Models\Plano;
use App\Models\Anexo;
use App\Models\Coinquilino;
use GuzzleHttp\Client;
use App\Http\Controllers\Api\ApiSpcController;
use Vindi\ApiRequester;
use Vindi;


class ContratoController extends Controller
{
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    //mostra o farmulario de cadastro do cliente
    public function cliente()
    {
        abort_if_forbidden('contrato.view');

        return view('cadastro.cliente.add');
    }

    //segunda parte do cadastro do cliente e primeira e em salvaspc qie consulta o clinete e previamente
    // salva no banco o score e renda presumida
    public function create(Request $request)
    {
        abort_if_forbidden('cliente.add');

        $this->validate($request,[
            'nome' => ['required', 'string'],
            'email' => ['required', 'email'],
            'telefone' => ['required'],
        ]);

        $activity = "\nEditado por: ".logObj(auth()->user());
        $cliente = Cliente::where('cpf',$request->get('cpf'))->first();
        $activity .="\nAntes das atualizações: ".logObj($cliente);

        //inicia o processo da vindi onde consulta se existe na plataforma
        $customerService = new Vindi\Customer;
        $customers = $customerService->all([        
            'query' => 'registry_code: ' . ApiSpcController::soNumero($request->get('cpf')) . ''        
        ]);

        if(empty($customers)){
            try{
                $customer = $customerService->create([
                    'name'  => $request->get('nome'),
                    'email' => $request->get('email'),
                    'registry_code' => '' .$request->get('cpf'). '',
                ]);
            }
            catch (Vindi\Exceptions\ValidationException $e)
            {
                message_set('Confira os dados do cliente','error',3);
                return redirect()->back(); 
            }
        }else{
            try{
                $customer = $customerService->update($customers[0]->id, [
                    'name'  => $request->get('nome'),
                    'email' => $request->get('email'),
                    'notes' => 'Cliente editado',
                ]);
            }
            catch (Vindi\Exceptions\ValidationException $e)
            {
                message_set('Confira os dados do cliente','error',3);
                return redirect()->back();  
            }
        }
        
        $request->id_vindi = $customer->id;
        //finaliza vind e devolve o codido deles.
        //salva o resto dos dados do cliente
        $cliente->fill($request->all());
        $cliente->save();
        
        $activity .="\nDepois de atualizar: ".logObj($cliente);
        LogWriter::user_activity($activity,date('Y-m-d'));

        //caso for coinquilino salva na tabela n-n e redireciona pra visuzalizar o contrato
        if($request->get('contrato')){
            //salva o cliente(coinquilino) que acabou de ser adicionado na tabela de coiquilinos n-n
            $cliente->contrato()->attach([$request->get('contrato')]);
            //busca o contrato para atualizar o status caso for necessario
            $contrato = Contrato::find($request->get('contrato'));
            //verifica se o status era necessario coinquilino e caso for muda o status caso for
            //negativa mantem o status anterior
            if($contrato->status == 'Aguardando Coinquilino'){
                if($cliente->score > 350){
                    $status = 'Aprovado';
                }else{
                    $status = 'Mesa de Análise';
                }
                $contrato->fill( ['status' => $status]);
                $contrato->save();
            }

           
            $activity ="\nCoinquilino add ao contrato: ".logObj($cliente);
            LogWriter::user_activity($activity,date('Y-m-d'));
            //redireciona para visualiza contrato caso o cadastro do cliente seja (coinquilino)
            return redirect()->route('contratoShow', ['id' => $request->get('contrato')]);
        }else{
            //redireciona para o cadastro do imovel caso o cadastro seja de cliente(inquilino)
            return redirect()->route('contratoImovel', ['cliente_id' => $cliente->id]);
        }
    }

    //busca o formulario para o cadastro do imovel
    public function imovel($id)
    {
        abort_if_forbidden('contrato.imovel.view');

        $cliente = Cliente::find($id);
        $taxas = Taxa::all();
        return view('cadastro.imovel.add',compact('cliente', 'taxas'));
    }
    //lista tdos os contratos cadastrados
    public function gestaoContratoShow()
    {
        $contratos = Contrato::orderBy('id', 'desc')->get();

        return view('gestao.contrato.show', compact('contratos'));

    }

    //visualiza todos os dados do contrato
    public function contratoShow($id)
    {
        abort_if_forbidden('contrato.imovel.view');
       
        $contrato = Contrato::find($id);
    
       $anexos = Anexo::where('id_contrato',@$id)->orWhere('id_cliente',@$contrato->id_cliente)->get();

        return view('cadastro.imovel.show',compact('contrato','anexos'));

    }

    public function contratoCoinquilino()
    {
        abort_if_forbidden('contrato.imovel.view');
 
        return view('cadastro.cliente.add');

    }

    public function createImovel(Request $request)
    {
        abort_if_forbidden('contrato.add');
        $activity = "\nAdicionado por: ".logObj(auth()->user());
    
        $this->validate($request,[
            'tipo_imovel' => ['required'],
            'cep' => ['required'],
            'rua' => ['required'],
            'numero' => ['required'],
            'cidade' => ['required'],
            'estado' => ['required'],
            'valor_locaticio' => ['required'],
            'id_taxa' => ['required'],
        ]);
        
        $cliente = Cliente::find($request->id_cliente);

        if($cliente['score'] <= 99 ){  
            $request->status = 'Mesa de Análise';
            $request->id_plano = 1;
        }elseif($cliente['score'] >= 100 && $cliente['score'] <= 350 ){ 
            $request->status ='Aguardando Coinquilino';
            $request->id_plano = 1;
        }elseif($cliente['score'] >= 351 && $cliente['score'] <= 550){
            $request->status ='Aprovado';
            $request->id_plano = 1;
        }elseif($cliente['score'] >= 551 && $cliente['score'] <= 800){
            $request->status ='Aprovado';
            $request->id_plano = 2;
        }elseif($cliente['score'] >= 801){
            $request->status ='Aprovado';
            $request->id_plano = 3;
        }
        $maisTrinta     = $cliente['renda']*35/100;
        $limite         = ($cliente['renda']+$maisTrinta)*30/100;

            //verifica se p valor do aluguel c enquadra no limite 
        if($limite < $request->valor_locaticio && $request->status != 'Aguadando Documentos' && $request->status != 'Mesa de Análise'){
            $request->status ='Aguardando Fatura do Cartão';
        }
    
        if($request->valor_locaticio > 5000 ){
            $request->status ='Aguadando Documentos';
            $request->id_plano = 4;
        }

        //dados do plano
        $plano = Plano::find($request->id_plano);
       
        $request->valor_plano = (($request->valor_locaticio * 12) / 100) * $plano->percentual;

        $request->id_user = auth()->user()->id;

        $contrato = Contrato::create([
            'tipo_imovel'=> $request->get('tipo_imovel'),
            'cep'=> $request->get('cep'),
            'rua'=> $request->get('rua'),
            'numero'=> $request->get('numero'),
            'cidade'=> $request->get('cidade'),
            'estado'=> $request->get('estado'),
            'bairro'=> $request->get('bairro'),
            'status'=> $request->get('status'),
            'complemento'=> $request->get('complemento'),
            'valor_locaticio'=> $request->get('valor_locaticio'),
            'status'=> $request->status,
            'valor_plano'=> $request->valor_plano,
            'id_plano'=> $request->id_plano,
            'id_taxa'=> $request->get('id_taxa'),
            'id_cliente'=> $request->get('id_cliente'),
            'id_user'=> $request->id_user,

        ]);
        
        $activity .="\nContrato: ".logObj($contrato);
        LogWriter::user_activity($activity,date('Y-m-d'));
        
        return redirect()->route('contratoShow', ['id' => $contrato->id]);

    }

    //consulta p spc e salva no banco
    public function salvaSpc($cpf)
    {   
        $consultaDB = Cliente::where('cpf',$cpf)->count();

        if($consultaDB > 0){
            $dados = Cliente::where('cpf',$cpf)->get();
            return [
                'nome' => $dados[0]->nome,
                'nascimento' => date('Y-m-d', strtotime($dados[0]->nascimento)),
                'telefone' => $dados[0]->telefone,
                'telefone_contato' => $dados[0]->telefone_contato,
                'email' => $dados[0]->email
            ];

        }else{
            $cliente = ApiSpcController::consultaCpf($cpf);
            
            if(isset($cliente['nome'])){
                
                $cliente = Cliente::create([
                    'nome'      => $cliente['nome'],
                    'cpf'       => $cpf,
                    'data_nasc' => date('Y-m-d', strtotime($cliente['nascimento'])),
                    'score'     => $cliente['score'],
                    'renda'     => $cliente['renda'],
                    'dossie'    => $cliente['dossie']
                ]);

                $activity ="\nConsulta Cliente: ".logObj($cliente);
                LogWriter::user_activity($activity,date('Y-m-d'));
            }

            return [
                'nome' => $cliente['nome'],
                'nascimento' => date('Y-m-d', strtotime($cliente['nascimento']))
            ];
        }

    }



}

?>