<?php

use Illuminate\Database\Seeder;
use App\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'user_id' => '1',
            'directory' => 'RemoteDemovZb2Bk',
            'name' => 'Relay Control Layout',
        ]);

        Module::create([
            'user_id' => '1',
            'directory' => 'RemoteDemojexYZb',
            'name' => 'Thermometer Control Layout',
        ]);
    }
}
