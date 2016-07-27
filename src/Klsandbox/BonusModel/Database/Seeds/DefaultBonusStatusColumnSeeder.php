<?php

namespace Klsandbox\BonusModel\Database\Seeds;

use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusStatus;
use Klsandbox\BonusModel\Models\Bonus;

class DefaultBonusStatusColumnSeeder extends Seeder
{
    public function run()
    {
        $active_id = BonusStatus::Active()->id;

        $bonusModel = config('bonus.bonus_model');
        foreach ($bonusModel::all() as $bonus) {
            $bonus->bonus_status_id = $bonus->bonus_status_id ? $bonus->bonus_status_id : $active_id;
            $bonus->save();
        }
    }
}
