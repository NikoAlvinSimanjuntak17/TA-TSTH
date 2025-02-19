<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the category ID for "pizza"
        $pizzaCategoryId  = DB::table('categories')
            ->where('category_name', 'pizza')
            ->value('id');

        // Insert the product using the category ID
        DB::table('products')->insert([
            'product_name' => 'Pizza Andaliman (Regular)',
            'product_deskripsi' => 'Pizza dengan sambal ciri khas',
            'price' => 65000,
            'product_category_name' => 'pizza',
            'product_category_id' => $pizzaCategoryId,
            'product_img' => 'upload/pizza-andaliman.jpg',
            'quantity' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $pizzaCategoryId  = DB::table('categories')
            ->where('category_name', 'pizza')
            ->value('id');

        // Insert the product using the category ID
        DB::table('products')->insert([
            'product_name' => 'Pizza Andaliman (Large)',
            'product_deskripsi' => 'Pizza dengan sambal ciri khas',
            'price' => 80000,
            'product_category_name' => 'pizza',
            'product_category_id' => $pizzaCategoryId,
            'product_img' => 'upload/pizza-andaliman.jpg',
            'quantity' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $foodCategoryId  = DB::table('categories')
            ->where('category_name', 'food')
            ->value('id');

        // Insert the product using the category ID
        DB::table('products')->insert([
            'product_name' => 'Nasi Putih',
            'product_deskripsi' => 'Nasi putih berkualitas',
            'price' => 6000,
            'product_category_name' => 'food',
            'product_category_id' => $foodCategoryId,
            'product_img' => 'upload/nasi.jpg',
            'quantity' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $snackCategoryId  = DB::table('categories')
            ->where('category_name', 'snack')
            ->value('id');

        // Insert the product using the category ID
        DB::table('products')->insert([
            'product_name' => 'Kentang Goreng',
            'product_deskripsi' => 'Kentang goreng berkualitas',
            'price' => 20000,
            'product_category_name' => 'snack',
            'product_category_id' => $snackCategoryId,
            'product_img' => 'upload/kentang.jpg',
            'quantity' => 10000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $foodCategoryId  = DB::table('categories')
        ->where('category_name', 'food')
        ->value('id');

    // Insert the product using the category ID
    DB::table('products')->insert([
        'product_name' => 'Telur Dadar',
        'product_deskripsi' => 'Telur ceplok atau dadar',
        'price' => 10000,
        'product_category_name' => 'food',
        'product_category_id' => $foodCategoryId,
        'product_img' => 'upload/telor.jpg',
        'quantity' => 10000,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    $softdrinkCategoryId  = DB::table('categories')
        ->where('category_name', 'soft drink')
        ->value('id');

    // Insert the product using the category ID
    DB::table('products')->insert([
        'product_name' => 'Teh Manis Dingin',
        'product_deskripsi' => 'Teh manis dengan es batu',
        'price' => 10000,
        'product_category_name' => 'soft drink',
        'product_category_id' => $softdrinkCategoryId,
        'product_img' => 'upload/mandi.jpg',
        'quantity' => 10000,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    $softdrinkCategoryId  = DB::table('categories')
    ->where('category_name', 'soft drink')
    ->value('id');

// Insert the product using the category ID
DB::table('products')->insert([
    'product_name' => 'Teh Manis Panas',
    'product_deskripsi' => 'Teh manis',
    'price' => 8000,
    'product_category_name' => 'soft drink',
    'product_category_id' => $softdrinkCategoryId,
    'product_img' => 'upload/manis.jpg',
    'quantity' => 10000,
    'created_at' => now(),
    'updated_at' => now()
]);
    }
}
