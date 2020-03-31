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
            'display_name' => 'Láva lámpa',
            'group_id' => '1',
            'user_id' => '1',
            'type_id' => '1',
            'module_id' => '1',
            'ip' => '92.168.0.222'
        ]);

        Device::create([
            'display_name' => 'Éjjeli szekrény lámpa',
            'group_id' => '1',
            'user_id' => '1',
            'type_id' => '1',
            'module_id' => '1'
        ]);

        Device::create([
            'display_name' => 'Kinti hőmérő',
            'group_id' => '1',
            'user_id' => '1',
            'type_id' => '2',
            'module_id' => '1',
            'ip' => '192.168.0.205'
        ]);
    }
}
