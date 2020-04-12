<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'    => 'remote',
            'email'    => 'remote@remote.org',
            'password'   =>  Hash::make('remote'),
            'remember_token' =>  Str::random(10),
            'device_token' => 'ZFLW-AZCR',
            'admin' => '1',
        ]);

        User::create([
            'username'    => 'guest',
            'email'    => 'guest@remote.org',
            'password'   =>  Hash::make('guest'),
            'remember_token' =>  Str::random(10),
            'device_token' => 'LENV-QYGO',
            'admin' => '0',
        ]);
    }
}
