<?php

use App\Reply;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reply::create([
            'user_id' =>1,
            'discussion_id' => 2,
            'content' =>"we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure"
        ]);

        Reply::create([
            'user_id' =>2,
            'discussion_id' => 3,
            'content' =>"Denounce with righteous indignation and dislike "
        ]);

        Reply::create([
            'user_id' =>1,
            'discussion_id' => 4,
            'content' =>"Can you help me out with my problem"
        ]);

        Reply::create([
            'user_id' =>2,
            'discussion_id' => 1,
            'content' =>"Anyone knows how to solve this...."
        ]);

        Reply::create([
            'user_id' =>2,
            'discussion_id' => 2,
            'content' =>"You are  a big troller,not helping anyone"
        ]);


        Reply::create([
            'user_id' =>1,
            'discussion_id' => 4,
            'content' =>"I am the best programmer,who can callenge me"
        ]);


        Reply::create([
            'user_id' =>1,
            'discussion_id' => 3,
            'content' =>"Yeah, thank you for yor answer!"
        ]);

    }
}
