<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
      Product::create([
      'name'=>'Apple',
      'price'=>1000, 
      'slug'=>2,
      'Details'=>'sadasdas',
      'Description'=>'asdjaskdas',

        // Select random entries to be featured
        ]);
        
      Product::create([
      'name'=>'Beetroot',
      'price'=>1000, 
      'slug'=>1,
      'Details'=>'sadasdas',
      'Description'=>'asdjaskdas',

        // Select random entries to be featured
        ]);
    }
}
