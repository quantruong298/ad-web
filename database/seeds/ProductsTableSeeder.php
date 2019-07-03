<?php

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
        $faker = Faker\Factory::create();

        DB::table('products')->truncate();

        $catalogs = DB::table('catalogs')->get()->toArray();
        $array_catalog_id = [];
        foreach ($catalogs as $catalog) {
            array_push($array_catalog_id, $catalog->id);
        }

        $users = DB::table('users')->where('role_id', '<>', 1)->get();
        $array_user_id = [];
        foreach ($users as $user) {
            array_push($array_user_id, $user->id);
        }

        for ($i = 0; $i < 50; $i++) {
            DB::table('products')->insert(
                [
                    'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                    'price' => $faker->randomNumber(4) * 1000,
                    'quantity' => $faker->randomNumber(2),
                    'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                    'image' => 'https://picsum.photos/id/' . $i . '/520/640',
                    'catalog_id' => $faker->randomElement($array_catalog_id),
                    'user_id' => $faker->randomElement($array_user_id)
                ]
            );
        }
    }
}
