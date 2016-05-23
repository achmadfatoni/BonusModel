<?php

namespace Klsandbox\BonusModel\Database\Seeds;

use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusPayout;
use Klsandbox\BonusModel\Models\BonusType;
use Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption;
use Klsandbox\SiteModel\Site;

class BonusTypeBonusPayoutOptionTableSeeder extends Seeder
{
    public function run()
    {
        if (BonusTypeBonusPayoutOption::count() > 0) {
            return;
        }

        foreach (Site::all() as $site) {
            Site::setSite($site);
            $this->runForSite($site->id);
        }
    }

    public function runForSite($siteId)
    {
        //        BonusTypeBonusPayoutOption::create(array(
//            'type_id' => BonusType::RestockBonus()->id,
//            'payout_id' => BonusPayout::RestockBonusPayoutGoldOption()->id,
//        ));
//
        BonusTypeBonusPayoutOption::create(array(
            'type_id' => BonusType::RestockBonus()->id,
            'payout_id' => BonusPayout::RestockBonusPayoutCashOption()->id,
        ));

//        BonusTypeBonusPayoutOption::create(array(
//            'type_id' => BonusType::IntroducerBonus()->id,
//            'payout_id' => BonusPayout::IntroducerBonusPayoutGoldOption()->id,
//        ));

        BonusTypeBonusPayoutOption::create(array(
            'type_id' => BonusType::IntroducerBonus()->id,
            'payout_id' => BonusPayout::IntroducerBonusPayoutCashOption()->id,
        ));
    }
}
