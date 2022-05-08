<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory('App\Event', 50)->create();
        for ($i= 1; $i>=50; $i++) {
            $faker = new Faker;

            $ins_data = [
                'title' => $faker->sentence,
                'description' => "<p>".implode("</p>\n\n<p>", $faker->paragraphs(rand(3,6)))."</p>",
            ];

            \App\Event::create($ins_data);
        }
    }
}
