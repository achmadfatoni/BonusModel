<?php

namespace Klsandbox\BonusModel\Database\Seeds;

use Illuminate\Database\Seeder;
use Klsandbox\BonusModel\Models\BonusStatus;

class BonusStatusTableSeeder extends Seeder
{
    public function run()
    {
        if (BonusStatus::all()->count() > 0) {
            return;
        }

        // StatusSeed
        $active = new BonusStatus();
        $active->name = 'Active';
        $active->save();

        $cancelled = new BonusStatus();
        $cancelled->name = 'Cancelled';
        $cancelled->save();
    }
}
