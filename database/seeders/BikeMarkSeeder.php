<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\Article;
use App\Models\MotoMark;
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
        MotoMark::create(['title' => 'Aprilia']);
        MotoMark::create(['title' => 'Bajaj']);
        MotoMark::create(['title' => 'Benelli']);
        MotoMark::create(['title' => 'BMW']);
        MotoMark::create(['title' => 'Buell']);
        MotoMark::create(['title' => 'CF Moto']);
        MotoMark::create(['title' => 'CZ Jawa']);
        MotoMark::create(['title' => 'Ducati']);
        MotoMark::create(['title' => 'Harley Davidson']);
        MotoMark::create(['title' => 'Honda']);
        MotoMark::create(['title' => 'Huaqvarna']);
        MotoMark::create(['title' => 'Indian']);
        MotoMark::create(['title' => 'Kawasaki']);
        MotoMark::create(['title' => 'KTM']);
        MotoMark::create(['title' => 'Minsk']);
        MotoMark::create(['title' => 'Moto Guzzi']);
        MotoMark::create(['title' => 'MV Augusta']);
        MotoMark::create(['title' => 'Piaggio']);
        MotoMark::create(['title' => 'Suzuki']);
        MotoMark::create(['title' => 'Triumph']);
        MotoMark::create(['title' => 'Victory']);
        MotoMark::create(['title' => 'Yamaha']);
    }
}
