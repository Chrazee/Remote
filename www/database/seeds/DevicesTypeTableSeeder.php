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
            'name' => 'lamp',
            'display_name' => 'Lámpák',
            'icon_id' => '1'
        ]);

        DeviceType::create([
            'name' => 'thermometer',
            'display_name' => 'Hőmérők',
            'icon_id' => '3'
        ]);

        DeviceType::create([
            'name' => 'switch',
            'display_name' => 'Kapcsolók',
            'icon_id' => '1',
        ]);

        DeviceType::create([
            'name' => 'sensor',
            'display_name' => 'Szenzorok',
            'icon_id' => '1'
        ]);
    }
}
