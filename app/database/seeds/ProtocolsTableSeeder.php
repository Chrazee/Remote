<?php

use Illuminate\Database\Seeder;
use App\Protocol;

class ProtocolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Protocol::create([
            'name' => 'http',
        ]);

        Protocol::create([
            'name' => 'https',
        ]);
    }
}
