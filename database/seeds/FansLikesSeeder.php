<?php

use Illuminate\Database\Seeder;

class FansLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 1000; $i++) {
            DB::table('fans_likes')->insert([
                'page'          => 'cocacola',
                'count'         => $faker->numberBetween(1000000, 10000000),
                'request_time'  => $faker->date('Y-m-d')
            ]);
        }
    }
}
