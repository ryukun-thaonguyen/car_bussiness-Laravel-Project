<?php

use App\Model\PromoteLimited;
use Illuminate\Database\Seeder;

class PromoteLimitedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1;$i<5;$i++){
            $p= new PromoteLimited();
            $p->user_id=2;
            $p->promote_id=$i;
            $p->save();
        }
    }
}
