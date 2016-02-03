<?php

namespace Klsandbox\BonusModel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\BonusModel\Models\BonusStatus
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\BonusStatus whereName($value)
 */
class BonusStatus extends Model
{

    protected $table = 'bonus_statuses';
    public $timestamps = true;

    public static function Active()
    {
        return BonusStatus::firstByAttributes(['name' => 'Active']);
    }

    public static function Cancelled()
    {
        return BonusStatus::firstByAttributes(['name' => 'Cancelled']);
    }
}
