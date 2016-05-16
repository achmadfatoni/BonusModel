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
 * @mixin \Eloquent
 */
class BonusPayout extends Model
{

    public function bonusCurrency()
    {
        return $this->belongsTo(BonusCurrency::class);
    }

    public static function IntroducerBonusPayoutGoldOption()
    {
        return BonusPayout::where(['key' => 'introducer-bonus-gold-option', 'site_id' => Site::id()])->first();
    }

    public static function IntroducerBonusPayoutCashOption()
    {
        return BonusPayout::where(['key' => 'introducer-bonus-cash-option', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonusPayoutGoldOption()
    {
        return BonusPayout::where(['key' => 'restock-bonus-gold-option', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonusPayoutCashOption()
    {
        return BonusPayout::where(['key' => 'restock-bonus-cash-option', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonusPayoutFirstItem()
    {
        return BonusPayout::where(['key' => 'restock-bonus-first-item', 'site_id' => Site::id()])->first();
    }

    public static function ReferralRestockFullBonus()
    {
        return BonusPayout::where(['key' => 'referral-restock-full-bonus', 'site_id' => Site::id()])->first();
    }

    // TODO: Remove once there are no more partials in DB
    public static function ReferralRestockPartialBonus()
    {
        return BonusPayout::where(['key' => 'referral-restock-partial-bonus', 'site_id' => Site::id()])->first();
    }

}
