<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Car;

class CarTableSeeder extends Seeder {

    public function run()
    {
        DB::table('nissan_new_cars')->delete();
        Car::create(['category_id' => 1, 'title' => 'Almera']);
        Car::create(['category_id' => 1, 'title' => 'Micra']);
        Car::create(['category_id' => 1, 'title' => 'Sentra']);
    }

}