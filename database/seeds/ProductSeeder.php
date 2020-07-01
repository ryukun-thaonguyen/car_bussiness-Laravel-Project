<?php

use App\model\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for($i=1;$i<=20;$i++){
            $name=$faker->name;
            $brand=["lamboghini","BWM","audi","bucati"];
            $type=["car","moto"];
            $product=new Product();
            $product->name=$name;
            $product->type=$type[random_int(0,1)];
            $product->brand=$brand[random_int(0,3)];
            $product->year=random_int(2000,2020);
            $product->price=random_int(1000,1000000);
            $product->mileage=random_int(500,10000);
            $product->image='["storage\/public\/product\/cars\/5ed94e4f66f82. jpeg","storage\/public\/product\/cars\/5ed94e4f67518. jpeg","storage\/public\/product\/cars\/5ed94e4f67d58. jpeg","storage\/public\/product\/cars\/5ed94e4f686eb. jpeg"]';
            $product->rate=random_int(1,5);
            $product->slug=str_replace(" ","-",$name);
            $product->save();
        }
    }
}
