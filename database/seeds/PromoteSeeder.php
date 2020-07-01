<?php

use App\Model\Promote;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PromoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for($i=1;$i<=10;$i++){
            $promote= new Promote();
            $promote->name=$faker->ean8;
            $promote->discount=random_int(1,100);
            $promote->limited=random_int(1,3);
            $promote->save();
        }
    }
}
