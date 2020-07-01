<?php

use App\Model\Comment;
use App\Model\Promote;
use App\Model\UserBalance;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PromoteSeeder::class);
        $this->call(PromoteLimitedSeeder::class);

    }
}
