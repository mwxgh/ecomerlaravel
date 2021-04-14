<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'=>'admin','display_name'=>'System Manage'],
            ['name'=>'guest','display_name'=>'Customer'],
            ['name'=>'developer','display_name'=>'System Develope'],
            ['name'=>'content','display_name'=>'Content Creator'],
        ]);
    }
}
