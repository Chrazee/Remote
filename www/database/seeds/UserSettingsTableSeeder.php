<?php

use App\UserSetting;
use Illuminate\Database\Seeder;

class UserSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSetting::create([
            'user_id' => '1',
        ]);
    }
}
