<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name' => 'Vegetables', 'slug' => 'Vegetables', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fruits', 'slug' => 'Fruits', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fibres', 'slug' => 'mobile-phones', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Raw Material', 'slug' => 'Raw Material', 'created_at' => $now, 'updated_at' => $now],

        ]);
    }
}
