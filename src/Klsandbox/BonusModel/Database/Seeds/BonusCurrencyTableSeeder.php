<?php

namespace Klsandbox\BonusModel\Database\Seeds;


use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusCurrency;
use Klsandbox\SiteModel\Site;

class BonusCurrencyTableSeeder extends Seeder {

    public function run() {
        if (BonusCurrency::count() > 0) {
            return;
        }

        foreach (Site::all() as $site) {
            Site::setSite($site);
            $this->runForSite($site->id);
        }
    }

    public function runForSite($siteId) {
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
