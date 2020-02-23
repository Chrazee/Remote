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

        Site::create([
            'name'    => 'site_homepage_group_id',
            'value'    => '-1',
        ]);

        Site::create([
            'name'    => 'api_key',
            'value'    => '',
        ]);
    }
}
