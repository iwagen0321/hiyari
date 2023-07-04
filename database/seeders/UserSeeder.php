<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'employee_number'=>'1001',
            'family_name'=>'岩本',
            'first_name'=>'とも',
            'division_name'=>'製造部製版課',
            'role'=>'1',
            'password'=>Hash::make('tttt1001'),
        ]);
    }
}
