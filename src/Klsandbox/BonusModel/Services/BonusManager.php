<?php

namespace Klsandbox\BonusModel\Services;

use App\Models\BonusCategory;
use App\Models\User;
use Klsandbox\OrderModel\Models\OrderItem;
use Carbon\Carbon;

interface BonusManager
{
    public function resolveBonus(OrderItem $orderItem);

    public function resolveBonusCommandsForOrderItemUserDetails($order_item_id, Carbon $created_at, OrderItem $orderItem, User $user, BonusCategory $orderItemBonusCategory);

    public function getExpiry(BonusCommand $bonusCommand);
}
