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

        $objs = $this->where(function($query_user) use($searchCriteria) {
                    // Pesquisando na tabela [User]
                    if (isset($searchCriteria['name']))
                        $query_user->where('name', 'like', "%{$searchCriteria['name']}%");
                })->orderBy('name')->paginate($totalPage);
        //->toSql();

        return $objs;
    }
}
