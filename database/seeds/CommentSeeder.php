<?php

use App\Model\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for($i=0;$i<5;$i++){
            $comment=new Comment();
            $comment->user_id=2;
            $comment->product_id=1;
            $comment->content="jshafgshfdgsdjgfsgfgsdhgfk";
            $comment->save();

        }

    }
}
