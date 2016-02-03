<?php

namespace Klsandbox\BonusModel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption
 *
 * @property-read \App\Models\BonusPayout $bonusPayout
 * @property-read \App\Models\BonusType $bonusType
 * @property integer $site_id
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $payout_id
 * @property integer $type_id
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption whereSiteId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption wherePayoutId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusTypeBonusPayoutOption whereTypeId($value)
 */
class BonusTypeBonusPayoutOption extends Model
{

    //
    protected $fillable = ['payout_id', 'type_id'];

    public function bonusPayout()
    {
        return $this->belongsTo(BonusPayout::class, 'payout_id');
    }

    public function bonusType()
    {
        return $this->belongsTo(BonusType::class, 'type_id');
    }

}
