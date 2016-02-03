<?php

namespace Klsandbox\BonusModel\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use App;
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
 * @property integer $bonus_status_id
 * @property string $canceled_at
 * @property integer $parent_bonus_id
 * @property-read \Klsandbox\BonusModel\Models\BonusStatus $bonusStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\Klsandbox\BonusModel\Models\Bonus[] $childBonuses
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereBonusStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereCanceledAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\BonusModel\Models\Bonus whereParentBonusId($value)
 * @property-read \Klsandbox\BonusModel\Models\Bonus $parentBonus
 */
class Bonus extends Model
{

    use \Klsandbox\SiteModel\SiteExtensions;

    public static function boot()
    {
        parent::boot();

        Bonus::created(function (Bonus $bonus) {
            $payout = $bonus->bonusPayout ? " payout:{$bonus->bonusPayout->key}" : "";
            Log::info("created\t#bonus:$bonus->id order:{$bonus->order->id} user:{$bonus->user->id} type:{$bonus->bonusType->key}$payout");

            if ($bonus->bonusPayout && !$bonus->bonusPayout->getAttribute('hidden')) {
                if ($bonus->bonusPayout->currency_amount == 0) {
                    App::abort(500, 'bad currency amount');
                }

                NotificationRequest::create(['target_id' => $bonus->id, 'route' => 'new-bonus-admin', 'channel' => 'Sms', 'to_user_id' => User::admin()->id]);
                NotificationRequest::create(['target_id' => $bonus->id, 'route' => 'new-bonus-user', 'channel' => 'Sms', 'to_user_id' => $bonus->awarded_to_user_id]);
                User::createUserEvent($bonus->user, ['created_at' => $bonus->created_at, 'controller' => 'timeline', 'route' => '/bonus-awarded', 'target_id' => $bonus->id]);
            }
        });

        Bonus::creating(function (Bonus $bonus) {
            $bonus->bonus_status_id = BonusStatus::Active()->id;
        });
    }

    protected $fillable = ['created_at', 'updated_at', 'workflow_status', 'bonus_payout_id', 'bonus_type_id', 'awarded_by_user_id', 'awarded_to_user_id', 'order_id', 'parent_bonus_id'];

    public function bonusPayout()
    {
        return $this->belongsTo('Klsandbox\BonusModel\Models\BonusPayout');
    }

    public function bonusType()
    {
        return $this->belongsTo('Klsandbox\BonusModel\Models\BonusType');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function parentBonus()
    {
        return $this->belongsTo('Klsandbox\BonusModel\Models\Bonus', 'parent_bonus_id');
    }

    public function bonusStatus()
    {
        return $this->belongsTo('Klsandbox\BonusModel\Models\BonusStatus');
    }

    public function user()
    {
        return $this->belongsTo(config('auth.model'), 'awarded_to_user_id');
    }

    public function childBonuses()
    {
        return $this->hasMany('Klsandbox\BonusModel\Models\Bonus', 'parent_bonus_id');
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
}
