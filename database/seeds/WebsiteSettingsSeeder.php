<?php

use App\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebsiteSetting::insert([

            'title'   => 'ANA - Login & Role Management System',
            'logo'    => 'logo.png',
            'favicon' => 'favicon.ico',
        ]);
    }
}
