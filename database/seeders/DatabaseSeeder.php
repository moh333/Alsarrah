<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin@123'),
            'image'    => 'user.png'
        ]);

        DB::table('settings')->insert([
            'header_logo'        => 'logo.png',
            'footer_logo'        => 'logo.png',
            'dashboard_logo'     => 'logo.png',
            'minidashboard_logo' => 'logo.png',
        ]);
    }
}
