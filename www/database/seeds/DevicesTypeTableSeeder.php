<?php

use Illuminate\Database\Seeder;
use App\DeviceType;

class DevicesTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceType::create([
            'name' => 'Lámpák',
            'icon_id' => '1',
            'user_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'Hőmérők',
            'icon_id' => '3',
            'user_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'Kapcsolók',
            'icon_id' => '1',
            'user_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'Szenzorok',
            'icon_id' => '1',
            'user_id' => '1',
        ]);


        DeviceType::create([
            'name' => 'Guests szenszorok',
            'icon_id' => '1',
            'user_id' => '2',
        ]);
    }
}
