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
            'user_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'Hőmérők',
            'user_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'Kapcsolók',
            'user_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'Szenzorok',
            'user_id' => '1',
        ]);


        DeviceType::create([
            'name' => 'Guests szenszorok',
            'user_id' => '2',
        ]);
    }
}
