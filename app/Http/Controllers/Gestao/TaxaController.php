<?php

namespace App\Http\Controllers\Gestao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Taxa;


class TaxaController extends Controller
{
    public function index()
    {
        abort_if_forbidden('taxa.view');

        $taxas = Taxa::all();
        return view('gestao.taxas.index',compact('taxas'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        abort_if_forbidden('taxa.add');

        $this->validate($request,[
            'nome' => ['required', 'unique:taxas', 'max:150'],
            'valor' => ['required', 'max:10'],
            'comissao' => ['required', 'max:10'],
            'parcelas' => ['required', 'max:3'],
        ]);

        $taxa = Taxa::create([
            'nome' => $request->get('nome'),
            'valor' => $request->get('valor'),
            'comissao' => $request->get('comissao'),
            'codigo_vindi' => $request->get('codigo_vindi'),
            'codigo_plano_vindi' => $request->get('codigo_plano_vindi'),
            'parcelas' => $request->get('parcelas')

        ]);

        $activity = "\nCriado por: ".json_encode(auth()->user())
        ."\nNova Taxa: ".json_encode($taxa);

        LogWriter::user_activity($activity,date('Y-m-d'));


        return redirect()->route('taxaIndex');
    }

    public function add()
    {
        abort_if_forbidden('taxa.add');
        return view('gestao.taxas.add');
    }

    public function toggleTaxaActivation($id)
    {
        
        $taxa = Taxa::where('id',$id)->first();
        $activity = "\nAtivado/Desativado por: ".logObj(auth()->user());
        $activity .="\n Depois Plano: ".logObj($taxa);
        LogWriter::user_activity($activity,date('Y-m-d'));
        return [
            'ativo' => $taxa->toggleTaxaActivation()
        ];
    }

    // plano edit page
    public function edit($id)
    {
        abort_if_forbidden('taxa.edit');
        $taxa = Taxa::find($id);
        return view('gestao.taxas.edit',compact('taxa'));
    }

    public function update(Request $request, $id)
    {
        abort_if_forbidden('taxa.edit');
        $activity = "\nAtualizado por: ".logObj(auth()->user());
        $this->validate($request,[
            'nome' => ['required', 'max:150'],
            'valor' => ['required', 'max:10'],
            'comissao' => ['required', 'max:10'],
            'parcelas' => ['required', 'max:3'],
        ]);


        $taxa = Taxa::find($id);
        $activity .="\nAntes das atualizações: ".logObj($taxa);
        $taxa->fill($request->all());
        $taxa->save();
        $activity .="\nAfter updates Taxa: ".logObj($taxa);

        LogWriter::user_activity($activity,date('Y-m-d'));

        return redirect()->route('taxaIndex');
    }

    public function destroy($id)
    {
        abort_if_forbidden('taxa.delete');
        $taxa = Taxa::find($id);
        $taxa->delete($id);
        message_set('Taxa Excluída','success',3);
        return redirect()->back();
    }



}

?>