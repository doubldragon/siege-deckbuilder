<?php

use Illuminate\Database\Seeder;

class CardsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('card_types')->insert([
            'type' => "Leader",
        ]);

        DB::table('card_types')->insert([
            'type' => "Castle",
        ]);

        DB::table('card_types')->insert([
            'type' => "Food",
        ]);  

        DB::table('card_types')->insert([
            'type' => "Morale",
        ]);

        DB::table('card_types')->insert([
            'type' => "Siege Engine",    
        ]); 

        DB::table('card_types')->insert([
            'type' => "Siege Defense",    
        ]);

        DB::table('card_types')->insert([
            'type' => "Espionage",    
        ]);     
    }
}
