<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' =>'Laravel','slug' => str_slug('Laravel')];
        $channel2 = ['title' =>'PHP','slug' => str_slug('PHP')];
        $channel3 = ['title' =>'HTML','slug' => str_slug('HTML')];
        $channel4 = ['title' =>'CSS','slug' => str_slug('CSS')];
        $channel5 = ['title' =>'Javascript','slug' => str_slug('Javascript')];
        $channel6 = ['title' =>'React','slug' => str_slug('React')];
        $channel7 = ['title' =>'Vue','slug' => str_slug('Vue')];


        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
    }
}
