<?php

namespace Klsandbox\BonusModel\Database\Seeds;

use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusPayout;
use Klsandbox\SiteModel\Site;
use Klsandbox\BonusModel\Models\BonusCurrency;

class BonusPayoutTableSeeder extends Seeder
{
    public function run()
    {
        if (BonusPayout::count() > 0) {
            return;
        }

        foreach (Site::all() as $site) {
            Site::setSite($site);
            $this->runForSite($site->id);
        }
    }

    public function runForSite($site)
    {
        BonusPayout::create(array(
            'key' => 'introducer-bonus-gold-option',
            'friendly_name' => 'Introducer Bonus Gold Option',
            'payout' => '1 gram of gold',
            'description' => 'This is the amount paid to an introducer, if they choose the gold option.',
            'hidden' => false,
            'bonus_currency_id' => BonusCurrency::GoldId(),
            'currency_amount' => 1,
        ));

        BonusPayout::create(array(
            'key' => 'introducer-bonus-cash-option',
            'friendly_name' => 'Introducer Bonus Cash Option',
            'payout' => 'RM 150',
            'description' => 'This is the amount paid to an introducer, if they choose the cash option.',
            'hidden' => false,
            'bonus_currency_id' => BonusCurrency::CashId(),
            'currency_amount' => 150,
        ));

        BonusPayout::create(array(
            'key' => 'restock-bonus-gold-option',
            'friendly_name' => 'Restock Bonus Gold Option',
            'payout' => '1 gram of gold',
            'description' => 'This is the amount of gold paid to someone when their restock meets the target, if they choose the gold option.',
            'hidden' => false,
            'bonus_currency_id' => BonusCurrency::GoldId(),
            'currency_amount' => 1,
        ));

        BonusPayout::create(array(
            'key' => 'restock-bonus-cash-option',
            'friendly_name' => 'Restock Bonus Cash Option',
            'payout' => 'RM 150',
            'description' => 'This is the amount paid to someone when their restock meets the target, if they choose the cash option.',
            'hidden' => false,
            'bonus_currency_id' => BonusCurrency::CashId(),
            'currency_amount' => 150,
        ));

        BonusPayout::create(array(
            'key' => 'restock-bonus-first-item',
            'friendly_name' => 'Restock Bonus for First Item',
            'payout' => 'RM 0',
            'description' => 'This is the amount paid to someone when thier restock meets the target, if they choose the cash option.',
            'hidden' => true,
            'bonus_currency_id' => BonusCurrency::CashId(),
            'currency_amount' => 0,
        ));

        BonusPayout::create(array(
            'key' => 'referral-restock-full-bonus',
            'friendly_name' => 'Referral Restock Full Bonus',
            'payout' => 'RM 80',
            'description' => 'This is the amount paid to someone when their referral restock meets the target, and they meet the minimum restocking requirements.',
            'hidden' => false,
            'bonus_currency_id' => BonusCurrency::CashId(),
            'currency_amount' => 80,
        ));
    }
}
