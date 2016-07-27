<?php

namespace Klsandbox\BonusModel\Database\Seeds;

use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusType;

class BonusTypeTableSeeder extends Seeder
{
    public function run()
    {
        if (BonusType::count() > 0) {
            return;
        }
        BonusType::create(array(
            'key' => 'introducer-bonus',
            'friendly_name' => 'Introducer Bonus',
            'description' => 'This bonus is awarded when someone introduces a new stockist.',
        ));

        BonusType::create(array(
            'key' => 'restock-bonus',
            'friendly_name' => 'Restock Bonus',
            'description' => 'This bonus is awarded to someone when their restock meets the target.',
        ));

        BonusType::create(array(
            'key' => 'referral-restock-bonus',
            'friendly_name' => 'Referral Restock Bonus',
            'description' => 'This bonus is awarded to someone when their referral restock meets the target, and they meet the minimum restocking requirements.',
        ));
    }
}
