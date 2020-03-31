
<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(SiteTableSeeder::class);
        $this->call(UsersTablesSeeder::class);
        $this->call(GroupsIconTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(DevicesTypeIconTableSeeder::class);
        $this->call(DevicesTypeTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
    }
}
