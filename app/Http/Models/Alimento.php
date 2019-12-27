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
        if (!isset($searchCriteria['data_fabricacao'])) {
            $searchCriteria['data_fabricacao'] = date('Y').'-01-01';                         
        }
        $searchCriteria['data_fabricacao'] =  $searchCriteria['data_fabricacao'].' 00:00:00';     

        //Defindo a data de validade como a ultima data caso não exita uma data final
        if (!isset($searchCriteria['data_validade'])) {
            $searchCriteria['dateLast'] = date('Y-m-d');
        }

        $searchCriteria['data_validade'] =  $searchCriteria['data_validade'].' 23:59:59';         

        $objs = $this->where(function($query_user) use($searchCriteria) {                    
                    if (isset($searchCriteria['nome']))
                        $query_user->where('nome', 'like', "%{$searchCriteria['nome']}%");                                    
                })->orderBy('nome')->paginate($totalPage);
        //->toSql();

        return $objs;
    }
}
