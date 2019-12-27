<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model{
    
    protected $table = "alimentos";

    protected $fillable = [
        'nome', 'preco', 'marca','tipo_id','data_fabricacao', 'data_validade', 'created_at', 'updated_at'
    ];
    
    public function tipo() {
        return $this->belongsTo('\App\Http\Models\Tipo', 'tipo_id');
    }

    public function search($searchCriteria, $totalPage) {

        //Defindo a data fabricação do ano como a primeira data caso não exita uma data inicial
        /*if (!isset($searchCriteria['data_fabricacao'])) {
            $searchCriteria['data_fabricacao'] = date('Y').'-01-01';                         
        }
        $searchCriteria['data_fabricacao'] =  $searchCriteria['data_fabricacao'].' 00:00:00';     

        //Defindo a data de validade como a ultima data caso não exita uma data final
        if (!isset($searchCriteria['data_validade'])) {
            $searchCriteria['dateLast'] = date('Y-m-d');
        }

        $searchCriteria['data_validade'] =  $searchCriteria['data_validade'].' 23:59:59';  */       

        $objs = $this->where(function($query_user) use($searchCriteria) {                
                    //Nome                       
                    if (isset($searchCriteria['nome']))
                        $query_user->where('nome', 'like', "{$searchCriteria['nome']}%");
                    //Marca
                    if (isset($searchCriteria['marca']))
                        $query_user->where('marca', 'like', "{$searchCriteria['marca']}%"); 
                    //Tipo
                    if (isset($searchCriteria['tipo_id']))
                        $query_user->where('tipo_id', '=', $searchCriteria['tipo_id']);   
                    //Intervalo de preços
                    if(isset($searchCriteria['preco_min']) && isset($searchCriteria['preco_max']))
                       $query_user->where('preco', ">=", $searchCriteria['preco_min'])->raw(' and preco <= '. $searchCriteria['preco_max']);
                    //Preço minino
                    if(isset($searchCriteria['preco_min']))
                       $query_user->where('preco', ">=", $searchCriteria['preco_min']);
                    //Preço máximo
                    if(isset($searchCriteria['preco_max']))
                       $query_user->where('preco', "<=", $searchCriteria['preco_max']);
                    //Intervalo de data de fabricação
                    if(isset($searchCriteria['data_fabricacao_inicial']) && isset($searchCriteria['data_fabricacao_final']))
                       $query_user->where('data_fabricacao', ">=", $searchCriteria['data_fabricacao_inicial'])->raw(' and data_fabricacao <= '. $searchCriteria['data_fabricacao_final']); 
                    //Data minima de frabricação
                    if(isset($searchCriteria['data_fabricacao_inicial']))
                       $query_user->where('data_fabricacao', ">=", $searchCriteria['data_fabricacao_inicial']);
                    //Data maxima de fabricação
                    if(isset($searchCriteria['data_fabricacao_final']))
                       $query_user->where('data_fabricacao', "<=", $searchCriteria['data_fabricacao_final']);
                   //Intervalo de data de validade
                    if(isset($searchCriteria['data_validade_inicial']) && isset($searchCriteria['data_validade_final']))
                       $query_user->where('data_validade', ">=", $searchCriteria['data_validade_inicial'])->raw(' and data_validade <= '. $searchCriteria['data_validade_final']); 
                    //Data minima de validade
                    if(isset($searchCriteria['data_validade_inicial']))
                       $query_user->where('data_validade', ">=", $searchCriteria['data_validade_inicial']);
                    //Data maxima de validade
                    if(isset($searchCriteria['data_validade_final']))
                       $query_user->where('data_validade', "<=", $searchCriteria['data_validade_final']);

                    
                })->orderBy('nome')->paginate($totalPage);
        //->toSql();

        return $objs;
    }
}
