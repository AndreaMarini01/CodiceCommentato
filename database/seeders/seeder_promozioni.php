<?php

namespace Database\Seeders;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_promozioni extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aziende = DB::table('aziendas')->pluck('idAzienda');

        $oggettiCoupon = [
            'Sconto su prodotto specifico',
            'Sconto sull\'intero carrello',
            'Buono regalo',
            'Spedizione gratuita',
            'Omaggio aggiuntivo',
            'Sconto per l\'acquisto successivo',
            '3 per 2',
        ];
        $luoghiFruizione = [
            'Negozi fisici',
            'Sito web',
            'App mobile',
            'Punti vendita',
            'E-commerce',
        ];

        $nomePromozioni = [
          'promo1',
          'promo2',
          'promo3',
          'promo4',
          'promo5',
          'promo6',
          'promo7'

        ];

        for ($i = 1; $i <= 10; $i++) {
            $aziendaId = $aziende->random();
            $oggettoCoupon = $oggettiCoupon[array_rand($oggettiCoupon)];
            $modalitaSconto = $this->getModalitaSconto($oggettoCoupon);
            $scontistica = mt_rand(1, 100);
            $luogoFruizione = $luoghiFruizione[array_rand($luoghiFruizione)];
            $nomePromozione = $nomePromozioni[array_rand($nomePromozioni)];


            $day= mt_rand(1, 28);
            $month= mt_rand(1, 12);
            $year = 2023;
            $date = date('d/m/Y', strtotime("$year-$month-$day"));
            $dateTime = DateTime::createFromFormat('d/m/Y', $date);

            DB::table('promozione')->insert([
                'idAzienda' => $aziendaId,
                'oggetto' => $oggettoCoupon,
                'modalità' => $modalitaSconto,
                'scontistica' => $scontistica,
                'luogoFruizione' => $luogoFruizione,
                'dataScadenza' => $dateTime,
                'nomePromozione'=> $nomePromozione

            ]);
        }
    }

    /**
     * Ottieni la modalità di sconto in base all'oggetto del coupon.
     *
     * @param string $oggettoCoupon
     * @return string
     */
    private function getModalitaSconto($oggettoCoupon)
    {
        return match ($oggettoCoupon) {
            'Sconto su prodotto specifico' => 'Sconto percentuale',
            'Sconto sull\'intero carrello' => 'Sconto percentuale',
            'Buono regalo' => 'Importo fisso',
            'Spedizione gratuita' => 'Sconto fisso',
            'Omaggio aggiuntivo' => 'Omaggio',
            'Sconto per l\'acquisto successivo' => 'Sconto percentuale',
            '3 per 2' => 'Sconto multiplo',
            default => '',
        };
    }


}


