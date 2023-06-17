<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promozione extends Model
{
    protected $table = 'promozione';
    protected $primaryKey = 'idPromozione';

    protected $fillable =[
        'oggetto', 'modalità',
        'scontistica',
        'luogoFruizione', 'dataScadenza',
        'nomePromozione', 'idAzienda'
    ];

    public $timestamps = false;

}
