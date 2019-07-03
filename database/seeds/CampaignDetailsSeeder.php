<?php

use Illuminate\Database\Seeder;

class CampaignDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('campaign_details')->truncate();

        $campaigns = DB::table('campaigns')->get()->toArray();
        $array_campaign_id = [];
        foreach ($campaigns as $campaign) {
            array_push($array_campaign_id, $campaign->id);
        }
        $dataInsert = [];
        for ($i = 0; $i < 15000; $i++) {
            $value_view = rand(0, 1);
            if ($value_view == 0) {
                $value_click = 1;
            } else {
                $value_click = 0;
            }
            $dataInsert[] = [
                'campaign_id' => $faker->randomElement($array_campaign_id),
                'views' => $value_view,
                'clicks' => $value_click,
                'datetime' => \Carbon\Carbon::today()->subDay(rand(0, 10)),
            ];
        }
        DB::table('campaign_details')->insert($dataInsert);
    }
}
