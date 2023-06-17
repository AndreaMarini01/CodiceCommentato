<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_aziende extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aziendas')->insert([
            'ragioneSociale' => 'Azienda 1 Srl',
            'localizzazione' => 'Milano, Italia',
            'nomeAzienda' => 'azienda1',
            'logo' => 'logo1.png',
            'tipologia' => 'Informatica',
            'descrizioneAzienda' => 'descrizione1',
        ]);

        DB::table('aziendas')->insert([
            'ragioneSociale' => 'Azienda 2 Spa',
            'localizzazione' => 'Roma, Italia',
            'nomeAzienda' => 'azienda2',
            'logo' => 'logo2.jpg',
            'tipologia' => 'Elettronica',
            'descrizioneAzienda' => 'descrizione2',
        ]);

        DB::table('aziendas')->insert([
            'ragioneSociale' => 'Azienda 3 Srl',
            'localizzazione' => 'Torino, Italia',
            'nomeAzienda' => 'azienda3',
            'logo' => 'logo3.png',
            'tipologia' => 'Telecomunicazioni',
            'descrizioneAzienda' => 'descrizione3',
        ]);

        DB::table('aziendas')->insert([
            'ragioneSociale' => 'Azienda 4 Spa',
            'localizzazione' => 'Firenze, Italia',
            'nomeAzienda' => 'azienda4',
            'logo' => 'logo4.png',
            'tipologia' => 'Software',
            'descrizioneAzienda' => 'descrizione4',
        ]);

        DB::table('aziendas')->insert([
            'ragioneSociale' => 'Azienda 5 Srl',
            'localizzazione' => 'Bologna, Italia',
            'nomeAzienda' => 'azienda5',
            'logo' => 'logo5.jpg',
            'tipologia' => 'Hardware',
            'descrizioneAzienda' => 'descrizione5',
        ]);
    }
}
