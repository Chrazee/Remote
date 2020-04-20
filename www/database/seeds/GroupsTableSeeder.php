<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'parent_id' => '-1',
            'user_id' => '1',
            'name' => 'Home'
        ]);

        Group::create([
            'parent_id' => '-1',
            'user_id' => '1',
            'name' => 'Office'
        ]);

        Group::create([
            'parent_id' => '2',
            'user_id' => '1',
            'name' => 'Server Room'
        ]);
    }
}
