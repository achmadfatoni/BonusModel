<?php

namespace Klsandbox\BonusModel\Models;

use Klsandbox\SiteModel\Site;
use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\BonusModel\Models\BonusType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption[] $bonusTypeBonusPayoutOptions
 * @property integer $site_id
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $key
 * @property string $friendly_name
 * @property string $description
 *
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereSiteId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereFriendlyName($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusType whereDescription($value)
 * @mixin \Eloquent
 */
class BonusType extends Model
{
    public static function IntroducerBonus()
    {
        return self::where(['key' => 'introducer-bonus', 'site_id' => Site::id()])->first();
    }

    public static function RestockBonus()
    {
        return self::where(['key' => 'restock-bonus', 'site_id' => Site::id()])->first();
    }

    public static function ReferralRestockBonus()
    {
        return self::where(['key' => 'referral-restock-bonus', 'site_id' => Site::id()])->first();
    }

    public function bonusTypeBonusPayoutOptions()
    {
        return $this->hasMany(BonusTypeBonusPayoutOption::class, 'type_id');
    }
}
