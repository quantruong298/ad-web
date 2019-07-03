<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersTableSeeder::class,
             CatalogsTableSeeder::class,
             ProductsTableSeeder::class,
             CampaignsTableSeeder::class,
             CampaignDetailsSeeder::class,
         ]);
    }
}
