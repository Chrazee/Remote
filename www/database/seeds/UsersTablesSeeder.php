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
            'name'    => 'darok',
            'email'    => 'ati@darok.me',
            'password'   =>  Hash::make('12345'),
            'remember_token' =>  Str::random(10),
        ]);
    }
}
