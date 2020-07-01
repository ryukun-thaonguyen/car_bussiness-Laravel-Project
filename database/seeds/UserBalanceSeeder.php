<?php

use App\Model\UserBalance;
use App\User;
use Illuminate\Database\Seeder;

class UserBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u=new UserBalance();
        $u->user_id=1;
        $u->balance=100000;
        $u->save();
    }
}
