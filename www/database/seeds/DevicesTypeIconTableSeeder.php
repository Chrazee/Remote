<?php

use Illuminate\Database\Seeder;
use App\DevicesTypeIcon;

class DevicesTypeIconTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DevicesTypeIcon::create([
            'name' => 'default.svg',
            'default' => '1',
        ]);

        DevicesTypeIcon::create([
            'name' => 'lighting.svg',
            'default' => '0',
        ]);

        DevicesTypeIcon::create([
            'name' => 'thermometer.svg',
            'default' => '0'
        ]);
    }
}
