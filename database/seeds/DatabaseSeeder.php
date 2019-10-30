<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert(
            [
                'name' => 'briedis',
                'email' => 'briedis@briedis.com',
                'password' => Hash::make('1')
            ]
        );

        foreach(range(1,30) as $val) {
            DB::table('authors')->insert(
                [
                    'name' => $faker->firstName(),
                    'surname' => $faker->lastName(),
                    'portret' => ''
                ]
            );
        }

        foreach(range(1,1000) as $val) {
            DB::table('books')->insert(
                [
                    'title' => $faker->realText(10),
                    'isbn' => $faker->isbn10(),
                    'pages' => rand(20, 600),
                    'about' => $faker->realText(600, 2),
                    'author_id' => rand(1, 29),
                ]
            );
        }
    }
}



