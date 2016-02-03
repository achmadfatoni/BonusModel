<?php

namespace Klsandbox\BonusModel\Models;

use Klsandbox\SiteModel\Site;
use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\BonusModel\Models\BonusPayout
 *
 * @property-read \App\Models\BonusCurrency $bonusCurrency
 * @property integer $site_id
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $key
 * @property string $friendly_name
 * @property string $payout
 * @property string $description
 * @property string $bonus_currency_id
 * @property integer $currency_amount
 * @property boolean $hidden
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereSiteId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereFriendlyName($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout wherePayout($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereBonusCurrencyId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereCurrencyAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusPayout whereHidden($value)
 */
class BonusPayout extends Model
{

    public function bonusCurrency()
    {
        return $this->belongsTo('App\Models\BonusCurrency');
    }

    public static function IntroducerBonusPayoutGoldOption()
    {
        return BonusPayout::firstByAttributes(['key' => 'introducer-bonus-gold-option', 'site_id' => Site::id()]);
    }

    public static function IntroducerBonusPayoutCashOption()
    {
        return BonusPayout::firstByAttributes(['key' => 'introducer-bonus-cash-option', 'site_id' => Site::id()]);
    }

    public static function RestockBonusPayoutGoldOption()
    {
        return BonusPayout::firstByAttributes(['key' => 'restock-bonus-gold-option', 'site_id' => Site::id()]);
    }

    public static function RestockBonusPayoutCashOption()
    {
        return BonusPayout::firstByAttributes(['key' => 'restock-bonus-cash-option', 'site_id' => Site::id()]);
    }

    public static function RestockBonusPayoutFirstItem()
    {
        return BonusPayout::firstByAttributes(['key' => 'restock-bonus-first-item', 'site_id' => Site::id()]);
    }

    public static function ReferralRestockFullBonus()
    {
        return BonusPayout::firstByAttributes(['key' => 'referral-restock-full-bonus', 'site_id' => Site::id()]);
    }

    public static function ReferralRestockPartialBonus()
    {
        return BonusPayout::firstByAttributes(['key' => 'referral-restock-partial-bonus', 'site_id' => Site::id()]);
    }

}
