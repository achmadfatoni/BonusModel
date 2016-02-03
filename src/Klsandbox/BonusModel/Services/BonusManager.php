<?php

namespace Klsandbox\BonusModel\Services;

use App;
use Klsandbox\OrderModel\Models\Order;
use Carbon\Carbon;

interface BonusManager
{
    function resolveBonus(Order $order);

    function resolveBonusCommandsForOrderUserDetails($order_id, Carbon $created_at, Order $order, $user);

    function getExpiry(BonusCommand $bonusCommand);

}
