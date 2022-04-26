<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Anexo;
use App\Services\LogWriter;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class UploadController extends Controller
{

          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadContrato(Request $request)
    {
        $name = uniqid($request->id);

        if ($request->hasFile('fatura') && $request->file('fatura')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->fatura->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            // Faz o upload:
            $upload = $request->fatura->storeAs('docs/fatura', $nameFile);
            $anexo = Anexo::create([
                'id_contrato'=> $request->get('id'),
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'fatura',
                'caminho'=> $upload,
            ]);
 
        }
        if ($request->hasFile('contrato') && $request->file('contrato')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->contrato->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->contrato->storeAs('docs/contrato', $nameFile);
            $anexo = Anexo::create([
                'id_contrato'=> $request->get('id'),
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'contrato',
                'caminho'=> $upload,
            ]);
        }
        if ($request->hasFile('vistoria') && $request->file('vistoria')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->vistoria->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->vistoria->storeAs('docs/vistoria', $nameFile);
            $anexo = Anexo::create([
                'id_contrato'=> $request->get('id'),
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'vistoria',
                'caminho'=> $upload,
            ]);
        }
        if ($request->hasFile('apolice') && $request->file('apolice')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->apolice->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->apolice->storeAs('docs/apolice', $nameFile);
            $anexo = Anexo::create([
                'id_contrato'=> $request->get('id'),
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'apolice',
                'caminho'=> $upload,
            ]);
        }
        if ($request->hasFile('contratoAdm') && $request->file('contratoAdm')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->contratoAdm->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->contratoAdm->storeAs('docs/contratoAdm', $nameFile);
            $anexo = Anexo::create([
                'id_contrato'=> $request->get('id'),
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'contratoAdm',
                'caminho'=> $upload,
            ]);
        }
        if ($request->hasFile('rgCpf') && $request->file('rgCpf')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->rgCpf->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->rgCpf->storeAs('docs/anexos', $nameFile);
            $anexo = Anexo::create([
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'rgCpf',
                'caminho'=> $upload,
            ]);
        }
        if ($request->hasFile('anexo1') && $request->file('anexo1')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->anexo1->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->anexo1->storeAs('docs/anexos', $nameFile);
            $anexo = Anexo::create([
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'anexos',
                'caminho'=> $upload,
            ]);
        }
        if ($request->hasFile('anexo2') && $request->file('anexo2')->isValid()) {
            // Recupera a extensão do arquivo
            $extension = $request->anexo2->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            $upload = $request->anexo2->storeAs('docs/anexos', $nameFile);
            $anexo = Anexo::create([
                'id_cliente'=> $request->get('id_cliente'),
                'tipo'=> 'anexos',
                'caminho'=> $upload,
            ]);
        }
        
        if ( !$upload )
            return redirect()
                        ->back()
                        ->with(message_set('Falha ao enviar arquivo','error',3))
                        ->withInput();
        else
            return redirect()
                            ->back()
                            ->with(message_set('Arquivo enviado com sucesso!','success',3));
        
    }
}
