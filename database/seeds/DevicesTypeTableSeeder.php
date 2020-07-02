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
            'user_id' => '1',
            'name' => 'Switches',
        ]);

        DeviceType::create([
            'user_id' => '1',
            'name' => 'Thermometers',
        ]);
    }
}
