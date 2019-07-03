<?php

use Illuminate\Database\Seeder;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('catalogs')->truncate();

        $catalogs = ['laptop', 'phone', 'tablet','backup'];
        $dataInsert = [];
        foreach ($catalogs as $catalog) {
            $dataInsert[] = ['name' => $catalog];
        }
        DB::table('catalogs')->insert($dataInsert);
        DB::table('catalogs')
            ->where('name','backup')
            ->update(['id' => 0]);
    }
}
