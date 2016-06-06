<?php

namespace Klsandbox\BonusModel\Models;

use App\Models\BonusCategory;
use Klsandbox\SiteModel\Site;
use Illuminate\Database\Eloquent\Model;
use Klsandbox\SiteModel\SiteExtensions;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusCategory[] $bonusCategoryRestockNew
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusCategory[] $bonusCategoryRestockOld
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusCategory[] $bonusCategoryIntroducer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusCategory[] $bonusCategoryReferral
 */
class BonusPayout extends Model
{
    use SiteExtensions;

    protected $fillable = ['friendly_name', 'key', 'description', 'payout', 'bonus_currency_id', 'currency_amount', 'hidden'];

    public function bonusCurrency()
    {
        return $this->belongsTo(BonusCurrency::class);
    }

    public function isUsed()
    {
        return $this->bonusCategoryRestockNew->count()
            || $this->bonusCategoryRestockOld->count()
            || $this->bonusCategoryIntroducer->count()
            || $this->bonusCategoryReferral->count();
    }

    public function bonusCategoryRestockNew()
    {
        return $this->hasMany(BonusCategory::class, 'restock_pair_new_bonus_payout_id');
    }

    public function bonusCategoryRestockOld()
    {
        return $this->hasMany(BonusCategory::class, 'restock_pair_old_bonus_payout_id');
    }

    public function bonusCategoryIntroducer()
    {
        return $this->hasMany(BonusCategory::class, 'introducer_bonus_payout_id');
    }

    public function bonusCategoryReferral()
    {
        return $this->hasMany(BonusCategory::class, 'referral_bonus_payout_id');
    }

    public static function IntroducerBonusPayoutGoldOption()
    {
        return self::where(['key' => 'introducer-bonus-gold-option', 'site_id' => Site::id()])->first();
    }

    public static function IntroducerBonusPayoutCashOption()
    {
        return self::where(['key' => 'introducer-bonus-cash-option', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonusPayoutGoldOption()
    {
        return self::where(['key' => 'restock-bonus-gold-option', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonusPayoutCashOption()
    {
        return self::where(['key' => 'restock-bonus-cash-option', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonusPayoutFirstItem()
    {
        return self::where(['key' => 'restock-bonus-first-item', 'site_id' => Site::id()])->first();
    }

    public static function ReferralRestockFullBonus()
    {
        return self::where(['key' => 'referral-restock-full-bonus', 'site_id' => Site::id()])->first();
    }

    // TODO: Remove once there are no more partials in DB
    public static function ReferralRestockPartialBonus()
    {
        return self::where(['key' => 'referral-restock-partial-bonus', 'site_id' => Site::id()])->first();
    }

    public static function findByName($name)
    {
        $bonus = self::forSite()->where('friendly_name', $name)
            ->first();

        assert($bonus);

        return $bonus;
    }
}
