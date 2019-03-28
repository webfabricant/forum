<?php

use Illuminate\Database\Seeder;

use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel', 'slug' => str_slug('Laravel')];
        $channel2 = ['title' => 'Vuejs', 'slug' => str_slug('Vuejs')];
        $channel3 = ['title' => 'Luman', 'slug' => str_slug('Luman')];
        $channel4 = ['title' => 'Codeignitor', 'slug' => str_slug('Codeignitor')];
        $channel5 = ['title' => 'PHP Storm', 'slug' => str_slug('PHP Storm')];
        $channel6 = ['title' => 'Yii2', 'slug' => str_slug('Yii2')];
        $channel7 = ['title' => 'Zend', 'slug' => str_slug('Zend')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);

    }
}
