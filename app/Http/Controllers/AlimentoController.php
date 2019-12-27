<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Alimento;
use App\Http\Models\Tipo;
use App\Http\Requests\FormRequestAlimentos;
use Illuminate\Support\Facades\DB;

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
        $this->cvData['tipos'] = Tipo::all();
        $this->cvData['cvObjects'] = $this->model->orderBy('nome')->with('tipo')->paginate($this->total_page);                
        return view($this->cvData['cvViewDirectory'].'.index', $this->cvData);
    }

    
    public function create(){
        $this->cvData['cvHeaderPage'] = "Cadastrar novo alimento";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        $this->cvData['tipos'] = Tipo::all();        
        return view($this->cvData['cvViewDirectory'].'.create', $this->cvData);
    }

    
    public function store(FormRequestAlimentos $request){
        //Validação do tipo do alimento            
        if ($request->input('tipo_id') == 'null'){            
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

    
    public function show($id){
        $this->cvData['alimento'] = $this->model->with('tipo')->find($id);         
        $this->cvData['cvHeaderPage'] = "Detalhes do alimento";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view($this->cvData['cvViewDirectory'].'.show', $this->cvData);
    }

    
    public function edit($id){
        $this->cvData['alimento'] = $this->model->find($id);        
        $this->cvData['tipos'] = Tipo::all();  
        $this->cvData['cvHeaderPage'] = "Editar:  ". $this->cvData['alimento']->nome;
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view($this->cvData['cvViewDirectory'].'.create', $this->cvData);
    }

    
    public function update(Request $request, $id){
        $updateData = $request->except('_token', '_method');
        $alimento = $this->model->find($id);
        $update = $alimento->update($updateData);
        if ($update)
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao editar [ ' . $updateData['nome'] . ' ]');
        else
            return redirect()->
                            route($this->cvData['cvRoute'] . '.edit', $id)->
                            with('errors', 'Falha ao editar [ ' . $updateData['nome'] . ' ]');
    }

    
    public function destroyOne($id){
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

    public function destroyMany(Request $request){        
        $ids = ($request->input("id"));
        if (!$ids == null) {        
            $total_itens = count($ids);                
            if ($total_itens > 1) {            
                //$delete = $this->model::whereRaw("id IN ({$id})")->delete();
                $delete = DB::table('alimentos')->whereIn('id', $ids)->delete();            
                $msg = $total_itens . " itens";

            } else {
                $delete =$this->model->find($ids[0])->delete();
                $msg = "1 item";
            } 
        } else{
             return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Erro ao excluir');
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
        $searchCriteria = $request->except('_token');        

        if (isset($searchCriteria['total_page'])) {
            $total_page = $searchCriteria['total_page'];
        } else {
            $total_page = $this->total_page;
        }

        $this->cvData['cvMenuPage']['index'] = 'active';
        $this->cvData['cvSearchCriteria'] = $searchCriteria;        
        $this->cvData['cvObjects'] = $this->model->search($searchCriteria, $total_page);

        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);
    }
}
