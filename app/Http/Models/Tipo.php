<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class Tipo extends Model {
    
    protected $table = "tipos";


    protected $fillable = [
        'nome'
    ];

}
