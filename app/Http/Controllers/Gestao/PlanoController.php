<?php

namespace App\Http\Controllers\Gestao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Plano;


class PlanoController extends Controller
{
    public function index()
    {
        abort_if_forbidden('plano.view');

        $planos = Plano::all();
        return view('gestao.planos.index',compact('planos'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        abort_if_forbidden('plano.add');

        $this->validate($request,[
            'nome' => ['required', 'unique:planos', 'max:150'],
            'limite' => ['required', 'max:10'],
        ]);

        $plano = Plano::create([
            'nome' => $request->get('nome'),
            'percentual' => $request->get('percentual'),
            'limite' => $request->get('limite')

        ]);

        $activity = "\nCriado por: ".json_encode(auth()->user())
        ."\nNovo Plano: ".json_encode($plano);

        LogWriter::user_activity($activity,date('Y-m-d'));


        return redirect()->route('planoIndex');
    }

    public function add()
    {
        abort_if_forbidden('plano.add');
        return view('gestao.planos.add');
    }

    public function togglePlanoActivation($id)
    {
        
        $plano = Plano::where('id',$id)->first();
        $activity = "\nAtivado/Desativado por: ".logObj(auth()->user());
        $activity .="\n Depois Plano: ".logObj($plano);
        LogWriter::user_activity($activity,date('Y-m-d'));
        
        return [
            'ativo' => $plano->togglePlanoActivation()
        ];
    }

    // plano edit page
    public function edit($id)
    {
        abort_if_forbidden('plano.edit');
        $plano = Plano::find($id);
        return view('gestao.planos.edit',compact('plano'));
    }

    public function update(Request $request, $id)
    {
        abort_if_forbidden('plano.edit');
        $activity = "\nAtualizado por: ".logObj(auth()->user());
        $this->validate($request,[
            'nome' => ['required', 'string', 'max:150'],
            'percentual' => ['required', 'max:5'],
            'limite' => ['required', 'max:10'],
        ]);

        $plano = Plano::find($id);
        $activity .="\nAntes das atualizações: ".logObj($plano);
        $plano->fill($request->all());
        $plano->save();
        $activity .="\nAfter updates User: ".logObj($plano);

        LogWriter::user_activity($activity,date('Y-m-d'));

        return redirect()->route('planoIndex');
    }

    public function destroy($id)
    {
        abort_if_forbidden('plano.delete');
        $plano = Plano::find($id);
        $plano->delete($id);
        message_set('Plano Excluído','success',3);
        return redirect()->back();
    }



}

?>