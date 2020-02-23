<?php

use Illuminate\Database\Seeder;
use App\GroupsIcon;

class GroupsIconTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupsIcon::create([
            'name' => 'default.svg',
            'default' => '1'
        ]);

        GroupsIcon::create([
            'name' => 'livingroom.svg',
            'default' => '0'
        ]);

        GroupsIcon::create([
            'name' => 'bedroom.svg',
            'default' => '0'
        ]);
    }
}
