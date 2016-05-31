<?php

namespace Klsandbox\BonusModel\Models;

use Klsandbox\SiteModel\Site;
use Illuminate\Database\Eloquent\Model;
use Klsandbox\SiteModel\SiteExtensions;

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
    use SiteExtensions;

    private static $cache;

    public static function findByName($name)
    {
        $name = strtolower($name);

        if (!self::$cache) {
            self::$cache = [];
        }

        if (!key_exists(Site::id(), self::$cache)) {
            self::$cache[Site::id()] = [];
        }

        if (key_exists($name, self::$cache[Site::id()])) {
            return self::$cache[Site::id()][$name];
        }

        $item = self::forSite()->where(['key' => $name])->first();
        assert($item, $name);

        self::$cache[Site::id()][$name] = $item;

        return $item;
    }

    public static function IntroducerBonus()
    {
        return self::findByName('introducer-bonus');
    }

    public static function RestockBonus()
    {
        return self::findByName('restock-bonus');
    }

    public static function ReferralRestockBonus()
    {
        return self::findByName('referral-restock-bonus');
    }

    public function bonusTypeBonusPayoutOptions()
    {
        return $this->hasMany(BonusTypeBonusPayoutOption::class, 'type_id');
    }
}
