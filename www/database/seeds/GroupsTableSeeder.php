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
            'name' => 'Test Group 1'

        ]);

        Group::create([
            'parent_id' => '-1',
            'user_id' => '1',
            'name' => 'Test Group 2'
        ]);

        Group::create([
            'parent_id' => '2',
            'user_id' => '1',
            'name' => 'Test Group 2 Sub 1'
        ]);

        Group::create([
            'parent_id' => '2',
            'user_id' => '1',
            'name' => 'Test Group 2 Sub 2'
        ]);

        Group::create([
            'parent_id' => '-1',
            'user_id' => '2',
            'name' => 'Guests Csoport'
        ]);


        Group::create([
            'parent_id' => '4',
            'user_id' => '1',
            'name' => 'Test Group 2 Sub 1 Sub 1'
        ]);
    }
}
