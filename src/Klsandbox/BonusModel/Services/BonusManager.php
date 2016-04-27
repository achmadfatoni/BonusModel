<?php

namespace Klsandbox\BonusModel\Services;

use Klsandbox\OrderModel\Models\OrderItem;
use Carbon\Carbon;

interface BonusManager
{
    function resolveBonus(OrderItem $orderItem);

    function resolveBonusCommandsForOrderItemUserDetails($order_item_id, Carbon $created_at, OrderItem $orderItem, $user);

    function getExpiry(BonusCommand $bonusCommand);

}
