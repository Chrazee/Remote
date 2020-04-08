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
            'name' => 'Láva lámpa',
            'group_id' => '1',
            'user_id' => '1',
            'type_id' => '1',
            'module_id' => '1',
            'protocol_id' => '1',
            'address' => '192.168.0.141'
        ]);

        Device::create([
            'name' => 'Éjjeli szekrény lámpa',
            'group_id' => '1',
            'user_id' => '1',
            'type_id' => '1',
            'module_id' => '1',
            'protocol_id' => '1',
            'address' => '192.168.0.105'
        ]);

        Device::create([
            'name' => 'Kinti hőmérő',
            'group_id' => '1',
            'user_id' => '1',
            'type_id' => '2',
            'module_id' => '1',
            'protocol_id' => '1',
            'address' => '192.168.0.200'
        ]);

        Device::create([
            'name' => 'Guests hőmérő',
            'group_id' => '5',
            'user_id' => '2',
            'type_id' => '5',
            'module_id' => '1',
            'protocol_id' => '1',
            'address' => '192.168.0.211'
        ]);
    }
}
