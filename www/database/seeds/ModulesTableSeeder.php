<?php

use Illuminate\Database\Seeder;
use App\Module;
use Illuminate\Support\Str;

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
            'directory' => 'fIGEaTSTZXjexYZb',
            'title' => 'Thermometer Controller',
            'description' => 'Thermometer Controller Description'

        ]);

        Module::create([
            'user_id' => '1',
            'directory' => 'r74YL4qbEzvZb2Bk',
            'title' => 'Test',
            'description' => 'Not valid content'
        ]);
    }
}
