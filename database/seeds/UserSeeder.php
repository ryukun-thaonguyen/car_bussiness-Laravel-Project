<?php

use App\Model\UserBalance;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $admin=new User();
        $admin->fullname="Nguyen Ngoc Thao Admin";
        $admin->email="admin@gmail.com";
        $admin->role="admin";
        $admin->password=Hash::make("admin");
        $admin->save();
        $u=new UserBalance();
        $u->user_id=1;
        $u->balance=100000;
        $u->save();

        $user=new User();
        $user->fullname="Nguyen Ngoc Thao User";
        $user->email="user@gmail.com";
        $user->role="user";
        $user->password=Hash::make("user");
        $user->save();
        $shipper=new User();
        $shipper->fullname="Nguyen Ngoc Thao Shipper";
        $shipper->email="shipper@gmail.com";
        $shipper->role="shipper";
        $shipper->password=Hash::make("shipper");
        $shipper->save();
        $role=['shipper','user'];
        for($i=0;$i<10;$i++){
            $u=new User();
            $u->fullname=$faker->name;
            $u->email=$faker->email;
            $u->role=$role[random_int(0,1)];
            $u->password=Hash::make($u->email);
            $u->save();
        }
    }
}
