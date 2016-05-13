<?php

namespace Klsandbox\BonusModel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\BonusModel\Models\BonusCurrency
 *
 * @property integer $site_id
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $key
 * @property string $friendly_name
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusCurrency whereSiteId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusCurrency whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusCurrency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusCurrency whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusCurrency whereFriendlyName($value)
 * @mixin \Eloquent
 */
class BonusCurrency extends Model
{

    public static function CashId()
    {
        return BonusCurrency::where(['key' => 'cash'])->first()->id;
    }

    public static function GoldId()
    {
        return BonusCurrency::where(['key' => 'gold'])->first()->id;
    }

    public static function BonusNotChosen()
    {
        return BonusCurrency::where(['key' => 'bonus-not-chosen'])->first();
    }

}
