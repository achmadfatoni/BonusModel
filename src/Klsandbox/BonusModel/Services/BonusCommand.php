<?php

namespace Klsandbox\BonusModel\Services;

use Klsandbox\OrderModel\Models\OrderItem;

class BonusCommand
{
    public $user;
    public $orderItem;
    public $orderPair;
    public $name;

    protected $bonusManager;

    public function __construct(BonusManager $bonusManager)
    {
        $this->bonusManager = $bonusManager;
    }

    public function getExpiry()
    {
        return $this->bonusManager->getExpiry($this);
    }

    /**
     * @param OrderItem $orderItem
     * @param $user
     * @param $orderItemPair
     *
     * @return BonusCommand
     */
    public static function createPayPairRestockBonus(BonusManager $bonusManager, OrderItem $orderItem, $user, $orderItemPair)
    {
        $command = new self($bonusManager);
        $command->user = $user;
        $command->orderItem = $orderItem;
        $command->orderPair = $orderItemPair;
        $command->name = 'payPairRestockBonus';

        return $command;
    }

    /**
     * @param OrderItem $orderItem
     * @param $user
     * @param $bonusManager
     *
     * @return BonusCommand
     */
    public static function createPayFullReferralRestockBonusCommand(BonusManager $bonusManager, OrderItem $orderItem, $user)
    {
        $command = new self($bonusManager);
        $command->user = $user;
        $command->orderItem = $orderItem;
        $command->name = 'payFullReferralRestockBonus';

        return $command;
    }
}
