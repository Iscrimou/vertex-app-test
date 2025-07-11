<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cep',
        'logradouro',
        'complemento',
        'unidade',
        'bairro',
        'localidade',
        'uf',
        'estado'
    ];
}
