<?php

use Illuminate\Database\Seeder;
use App\Device;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::create([
            'user_id' => '1',
            'group_id' => '1',
            'type_id' => '1',
            'module_id' => '1',
            'protocol_id' => '1',
            'name' => 'Relay',
            'address' => '192.168.0.141'
        ]);

        Device::create([
            'name' => 'Rack Cabinet inner thermometer',
            'group_id' => '3',
            'user_id' => '1',
            'type_id' => '2',
            'module_id' => '2',
            'protocol_id' => '1',
            'address' => '192.168.0.217'
        ]);
    }
}
