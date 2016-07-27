<?php

namespace Klsandbox\BonusModel\Database\Seeds;

use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusCurrency;

class BonusCurrencyTableSeeder extends Seeder
{
    public function run()
    {
        if (BonusCurrency::count() > 0) {
            return;
        }
        BonusCurrency::create(array(
            'key' => 'cash',
            'friendly_name' => 'Cash',
        ));

        BonusCurrency::create(array(
            'key' => 'gold',
            'friendly_name' => 'Gold',
        ));

        BonusCurrency::create(array(
            'key' => 'bonus-not-chosen',
            'friendly_name' => 'Bonus Not Chosen',
        ));
    }
}
