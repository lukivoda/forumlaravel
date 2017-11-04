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
        $channel1 = ['title' =>'Laravel'];
        $channel2 = ['title' =>'PHP'];
        $channel3 = ['title' =>'HTML'];
        $channel4 = ['title' =>'CSS'];
        $channel5 = ['title' =>'Javascript'];
        $channel6 = ['title' =>'React'];
        $channel7 = ['title' =>'Vue'];


        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
    }
}
