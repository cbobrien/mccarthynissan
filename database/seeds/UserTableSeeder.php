<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(['email' => 'connoro@cbrmarketing.co.za', 'password' => Hash::make('Password123')]);
    }

}