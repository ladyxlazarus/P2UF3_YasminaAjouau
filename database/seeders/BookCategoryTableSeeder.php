<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BookCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create(); //genera datos aleatorios
        $now = Carbon::now();

        //ahora obtenemos todos los ids de libros y categorias para generar las relaciones aleatorias
        $bookIds = DB::table('books')->pluck('id')->all();
        $categoryIds = DB::table('categories')->pluck('id')->all();

        foreach ($bookIds as $bookId) {
            //genero una cantidad aleatoria de de categorias entre 1 y 3 que tendrán los libros
            $countCategories = $faker->numberBetween(1, 3);

            //este método de faker recoge elementos aleatorios de un array y le pasamos por segundo parametro la cantidad que queremos
            $selectedCategories = $faker->randomElements($categoryIds, $countCategories);

            //por cada categoria elegida aleatoriamente hago un insert con su libro
            foreach ($selectedCategories as $selected) {
                DB::table('book_category')->insert([
                    'book_id' => $bookId,
                    'category_id' => $selected,
                    'created_at' => $faker->dateTimeBetween("-1 month", "now")->format('Y-m-d'),
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
