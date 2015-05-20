<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Category;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('nissan_new_car_categories')->delete();
        Category::create(['category' => 'Passenger']);
        Category::create(['category' => 'Electric']);
        Category::create(['category' => 'Sports']);
        Category::create(['category' => 'Crossover']);
        Category::create(['category' => 'Sports-Utility']);
        Category::create(['category' => 'Commercial']);
    }

}