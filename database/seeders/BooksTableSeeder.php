<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $now = Carbon::now(); //la usaré para el updated_at, devuelve la fecha  y hora actual en la ejecución

        for ($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
                'isbn' => $faker->unique()->isbn10(), //devuelve un isbn random
                'title' => $faker->sentence(10), //tipo cadena de texto máximo 10 palabras
                'author' => $faker->name(),
                'published_date' => $faker->date(),
                'description' => $faker->paragraph(2), //cadena de texto máximo 2 parrafos 
                'price' => $faker->randomFloat(2, 0, 100),
                'created_at' => $faker->dateTimeBetween("-1 month", "now")->format('Y-m-d'),
                //para que no salgan las mismas fechas, pongo una aleatoria de hace un mes para created_at
                'updated_at' => $now,
            ]);
        }
    }
}
