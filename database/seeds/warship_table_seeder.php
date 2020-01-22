<?php

use App\Warship;
use Illuminate\Database\Seeder;

class warship_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warship::insert([
            'name' => "USS Missouri",
	        'class' => "Iowa-class battleship",
            'built' => "New York Naval Shipyard, Brooklyn, New York",
            'length' => "270.4m",
            'height' => "63.9m",
            'power' => "212,000 shaft horsepower",
            'speed' => "30 knots",
        ]);
        Warship::insert([
            'name' => "Musashi",
            'class' => "Yamato-class battleship",
            'built' => "Mitsubishi Shipyard, Nagasaki",
            'length' => "244m",
            'height' => "63m",
            'power' => "12 × Kanpon water-tube boilers",
            'speed' => "27.5 knots",
        ]);
        Warship::insert([
            'name' => "Bismarck",
            'class' => "Bismarck-class battleship",
            'built' => "Blohm & Voss, Hamburg",
            'length' => "241.6m",
            'height' => "70m",
            'power' => "12 Wagner superheated boilers",
            'speed' => "30.01 knots",
        ]);
    }
}
