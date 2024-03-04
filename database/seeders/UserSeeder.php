<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name'=>'super',
                'email'=>'kevintique86@gmail.com',
                'email_verified_at'=>Carbon::now(),
                'password'=> Hash::make('123qwe')
            ]
            );
    }
}
