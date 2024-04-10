<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\Article;
use App\Models\BikeMark;
use App\Models\Note;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BikeMarkSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BikeMark::create(['title' => 'Aprilia']);
        BikeMark::create(['title' => 'Bajaj']);
        BikeMark::create(['title' => 'Benelli']);
        BikeMark::create(['title' => 'BMW']);
        BikeMark::create(['title' => 'Buell']);
        BikeMark::create(['title' => 'CF Moto']);
        BikeMark::create(['title' => 'CZ Jawa']);
        BikeMark::create(['title' => 'Ducati']);
        BikeMark::create(['title' => 'Harley Davidson']);
        BikeMark::create(['title' => 'Honda']);
        BikeMark::create(['title' => 'Huaqvarna']);
        BikeMark::create(['title' => 'Indian']);
        BikeMark::create(['title' => 'Kawasaki']);
        BikeMark::create(['title' => 'KTM']);
        BikeMark::create(['title' => 'Minsk']);
        BikeMark::create(['title' => 'Moto Guzzi']);
        BikeMark::create(['title' => 'MV Augusta']);
        BikeMark::create(['title' => 'Piaggio']);
        BikeMark::create(['title' => 'Suzuki']);
        BikeMark::create(['title' => 'Triumph']);
        BikeMark::create(['title' => 'Victory']);
        BikeMark::create(['title' => 'Yamaha']);
    }
}
