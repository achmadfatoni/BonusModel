<?php

namespace Klsandbox\BonusModel\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Klsandbox\BonusModel\Models\Bonus
 *
 * @property-read \Klsandbox\BonusModel\Models\BonusPayout $bonusPayout
 * @property-read \Klsandbox\BonusModel\Models\BonusType $bonusType
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\User $user
 * @property integer $site_id
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $workflow_status
 * @property integer $bonus_payout_id
 * @property integer $bonus_type_id
 * @property integer $awarded_by_user_id
 * @property integer $awarded_to_user_id
 * @property integer $order_id
 *
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereSiteId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereWorkflowStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereBonusPayoutId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereBonusTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereAwardedByUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereAwardedToUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereOrderId($value)
 *
 * @property integer $bonus_status_id
 * @property string $canceled_at
 * @property integer $parent_bonus_id
 * @property-read \Klsandbox\BonusModel\Models\BonusStatus $bonusStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\Klsandbox\BonusModel\Models\Bonus[] $childBonuses
 *
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereBonusStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereCanceledAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereParentBonusId($value)
 *
 * @property-read \Klsandbox\BonusModel\Models\Bonus $parentBonus
 */
abstract class Bonus extends Model
{
    protected $fillable = [
        'created_at',
        'updated_at',
        'workflow_status',
        'bonus_payout_id',
        'bonus_type_id',
        'awarded_by_user_id',
        'awarded_to_user_id',
        'order_id',
        'order_item_id',
        'parent_bonus_id',
        'awarded_by_organization_id', ];

    public function bonusPayout()
    {
        return $this->belongsTo(BonusPayout::class);
    }

    public function bonusType()
    {
        return $this->belongsTo(BonusType::class);
    }

    public function order()
    {
        return $this->belongsTo(\Klsandbox\OrderModel\Models\Order::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'awarded_by_organization_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(\Klsandbox\OrderModel\Models\OrderItem::class);
    }

    public function parentBonus()
    {
        return $this->belongsTo(get_class($this), 'parent_bonus_id');
    }

    public function bonusStatus()
    {
        return $this->belongsTo(BonusStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(config('auth.model'), 'awarded_to_user_id');
    }

    public function childBonuses()
    {
        return $this->hasMany(get_class($this), 'parent_bonus_id');
    }

    public function cancelBonusAndChildBonuses()
    {
        $this->canceled_at = new Carbon();
        $this->bonus_status_id = BonusStatus::Cancelled()->id;

        $this->save();

        foreach ($this->childBonuses as $child) {
            $child->canceled_at = new Carbon();
            $child->bonus_status_id = BonusStatus::Cancelled()->id;

            $child->save();
        }
    }

    public function info()
    {
        return "id:$this->id status:{$this->bonusStatus->name} type:{$this->bonusType->friendly_name} payout:{$this->bonusPayout->key}";
    }

    public static function infoMap($bonuses)
    {
        return $bonuses->map(function ($e) {return $e->info();});
    }
}
