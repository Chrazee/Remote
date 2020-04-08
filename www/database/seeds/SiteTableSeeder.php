<?php

use Illuminate\Database\Seeder;
use App\Site;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'name'    => 'site_name',
            'value'    => 'Remote',
        ]);
    }
}
