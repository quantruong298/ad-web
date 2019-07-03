<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('campaigns')->truncate();

        $status = [1, 2];
        $type_id = [1, 2];

        $users = DB::table('users')->where('role_id', '<>', 1)->get();

        $dataInsert = [];

        foreach ($users as $user) {
            $products = DB::table('products')->where('user_id', $user->id)->get();
            foreach ($products as $product) {
                for ($i = 1; $i <= 3; $i++) {
                    $day_temp = \Carbon\Carbon::today()->subDay(rand(-10, 10));
                    $start_date = clone  $day_temp;
                    $end_date = $day_temp->addDays(rand(1, 7));
                    $image = 'https://picsum.photos/id/' . $faker->randomNumber(3) . '/900/300';
                    $dataInsert[] = [
                        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                        'user_id' => $user->id,
                        'status' => $faker->randomElement($status),
                        'start_day' => $start_date,
                        'end_day' => $end_date,
                        'budget' => $faker->randomNumber(5),
                        'bid_amount' => $faker->randomNumber(2),
                        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                        'product_id' => $product->id,
                        'link' => $image,
                        'banner' => $image,
                        'file_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                        'type_id' => $faker->randomElement($type_id),
                        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    ];
                }
            }

        }
        DB::table('campaigns')->insert($dataInsert);
    }
}
