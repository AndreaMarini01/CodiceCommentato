<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_Faq extends Seeder
{
    public function run(){
        $domande= ['Come cerco un codice sconto?',
            'Come uso un codice sconto?',
            'Posso usare un codice sconto più volte nello stesso ordine?',
            'Come posso pubblicare delle promozioni per il mio shop sul vostro sito?'
        ];
        $risposte = ["È semplice. Se hai intenzione di fare acquisti in uno shop specifico, puoi fare la tua ricerca inserendo il nome del coupon o il nome dell'azienda all'interno della apgina di catalogo, cliccando sul pulsante 'filtri'.",
            "Una volta all'interno del proprio profilo, vai nella sezione 'Mostra coupon salvati'. All'interno, troverai tutti i rispettivi codici da inserire sul sito di riferimento.",
            'No, puoi usare un solo codice sconto a transazione.',
            "Valutiamo tutte le proposte di partnership. Invia una mail ad uno degli indirizzi presenti a fondo pagina. Lo staff ti farà sapere al più presto quando sarà disponibile"
        ];

        for ($i=0; $i < sizeof($domande); $i++){
            DB::table('faq')->insert([
                    'domanda'=> $domande[$i],
                    'risposta' => $risposte[$i]
                ]
            );
        }
    }
}
