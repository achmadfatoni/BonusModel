<?php

namespace Klsandbox\BonusModel\Services;

use App;

class BonusCommand
{
    public $user;
    public $order;
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
