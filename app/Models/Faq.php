<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'Faq';
    protected $primaryKey = 'id';

    protected $fillable = [
        'domanda',
        'risposta'
    ];
    public $timestamps = false;

}
