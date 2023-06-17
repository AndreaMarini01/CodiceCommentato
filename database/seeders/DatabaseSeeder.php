<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('Database\Seeders\seeder_utenti');
        $this->call('Database\Seeders\seeder_aziende');
        $this->call('Database\Seeders\seeder_promozioni');
        $this->call('Database\Seeders\seeder_Faq');
        $this->call('Database\Seeders\seeder_emissione_coupon');

    }
}
