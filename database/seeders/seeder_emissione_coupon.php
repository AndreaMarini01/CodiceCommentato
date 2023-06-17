<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class seeder_emissione_coupon extends Seeder
{
    /**

    Run the database seeds.*
    @return void*/
    //Genera automaticamente offerte per gli utente aventi role=user
    //La funzione pluck prende tutti i valori della colonna idPromozione
    public function run(){
        $promozioni = DB::table('promozione')->pluck('idPromozione');
        $utenti = DB::table('users')->where('role','user')->pluck('id');

        foreach ($promozioni as $promozione) {
            foreach ($utenti as $utente) {
                $dataEmissione = now()->subDays(rand(1, 30))->toDateString();
                $codice = Str::random(10);

                DB::table('emissione_coupon')->insert([
                    'idPromozione' => $promozione,
                    'idUtente' => $utente,
                    'dataEmissione' => $dataEmissione,
                    'codice' => $codice,
                ]);
            }
        }
    }
}
