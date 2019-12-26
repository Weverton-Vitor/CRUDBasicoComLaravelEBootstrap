<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Alimento;
use App\Http\Models\Tipo;

class AlimentoController extends Controller
{
    private $total_page = 10;
    private $cvData;
    private $model;

    public function __construct(Alimento $model) {
        $this->model = $model;
        $this->cvData['cvRoute'] = 'alimentos';
        $this->cvData['cvViewDirectory'] = 'alimentos';
        $this->cvData['cvHeaderPage'] = "Alimentos";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
       
    }
    
    public function index(){        
        
        $this->cvData['cvObjects'] = $this->model->orderBy('nome')->with('tipo')->paginate($this->total_page);                
        return view($this->cvData['cvViewDirectory'].'.index', $this->cvData);
    }

    
    public function create(){
        $this->cvData['cvHeaderPage'] = "Cadastrar novo alimento";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        $this->cvData['tipos'] = Tipo::all();        
        return view($this->cvData['cvViewDirectory'].'.create', $this->cvData);
    }

    
    public function store(Request $request){
        //Validação do tipo do alimento
        if ($request->input('tipo') == 'null') {
          return redirect()->
                            route($this->cvData['cvRoute'] . '.create')->
                            with('error', 'Por favor selecione o tipo do alimento');
        } else{
            $alimento = $request->except('_token');            
            $store = $this->model->create($alimento);
            if ($store)
                return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao registrar alimento [ ' . $alimento['nome'] . ' ]');
            else
                return redirect()->
                                route($this->cvData['cvRoute'] . '.index')->
                                with('error', 'Falha ao adicionar alimento [ ' . $alimento['nome'] . ' ]');
        }
    }

    
    public function show($id)
    {
       return 19;
    }

    
    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id){
        if (isset($id)) {
            $obj = $this->model::find($id);
            $delete = $obj->delete();
            $msg = $obj['nome'];
        } else {
            $msg = $id;
        }

        if ($delete)
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao excluir [ ' . $msg . ' ]');
        else
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Erro ao excluir [ ' . $msg . ' ]');
    }

    public function search(Request $request){
        
    }
}
