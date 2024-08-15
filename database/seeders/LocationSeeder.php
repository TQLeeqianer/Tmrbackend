<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            ['name' => 'Johor', 'latitude' => 1.4927, 'longitude' => 103.7414],
            ['name' => 'Kedah', 'latitude' => 6.1248, 'longitude' => 100.3671],
            ['name' => 'Kelantan', 'latitude' => 6.1254, 'longitude' => 102.2387],
            ['name' => 'Malacca (Melaka)', 'latitude' => 2.1896, 'longitude' => 102.2501],
            ['name' => 'Negeri Sembilan', 'latitude' => 2.7297, 'longitude' => 101.9381],
            ['name' => 'Pahang', 'latitude' => 3.9354, 'longitude' => 102.3289],
            ['name' => 'Penang (Pulau Pinang)', 'latitude' => 5.4164, 'longitude' => 100.3327],
            ['name' => 'Perak', 'latitude' => 4.5921, 'longitude' => 101.0901],
            ['name' => 'Perlis', 'latitude' => 6.4457, 'longitude' => 100.2036],
            ['name' => 'Selangor', 'latitude' => 3.0738, 'longitude' => 101.5183],
            ['name' => 'Terengganu', 'latitude' => 5.3117, 'longitude' => 103.1324],
            ['name' => 'Sabah', 'latitude' => 5.9788, 'longitude' => 116.0754],
            ['name' => 'Sarawak', 'latitude' => 1.5533, 'longitude' => 110.3592],
            ['name' => 'Kuala Lumpur (the national capital)', 'latitude' => 3.1390, 'longitude' => 101.6869],

        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
