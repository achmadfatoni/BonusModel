<?php

namespace Klsandbox\BonusModel\Services;

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
}
