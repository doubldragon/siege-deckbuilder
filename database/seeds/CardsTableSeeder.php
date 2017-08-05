<?php

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards')->insert([
        'isMonarch' => true,
        'name' => "Aethelred the Unready",
        'type_id' => 1,
        'action' => "+1 to defense on Invader's second attack in a turn",
        'effect' => "-1 to attack at range 2",
        'flavor_text' => "He swore he was prepared. He lied.",
            ]);

        DB::table('cards')->insert([
        'isMonarch' => true,
        'name' => "Richard the Lesser",
        'type_id' => 1,
        'action' => "+1 to attack at range 2",
        'effect' => "+1 food consumed when building siege defenses",
        'flavor_text' => "Crusade? More like Study Abroad.",
            ]);

        DB::table('cards')->insert([
        'isMonarch' => false,
        'name' => "Charlemaybe",
        'type_id' => 1,
        'action' => "+1 to morale when troops attack",
        'effect' => "-1 defense to supply line",
        'flavor_text' => "Definitely not the greatest Charles, but not the worst either.",
            ]);

        DB::table('cards')->insert([
        'isMonarch' => false,
        'name' => "The Mad King",
        'type_id' => 1,
        'action' => "+1 to siegecraft",
        'effect' => "-1 to morale",
        'flavor_text' => "That boy crazy.",
            ]);

        factory('App\Card', 20)->create();
    }
}
