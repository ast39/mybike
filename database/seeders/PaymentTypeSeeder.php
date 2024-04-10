<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\Article;
use App\Models\BikeMark;
use App\Models\Note;
use App\Models\PaymentType;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PaymentTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create(['title' => 'Налог']);
        PaymentType::create(['title' => 'ОСАГО']);
        PaymentType::create(['title' => 'КАСКО']);
        PaymentType::create(['title' => 'Штраф']);
        PaymentType::create(['title' => 'Мойка']);
        PaymentType::create(['title' => 'Паркинг']);
        PaymentType::create(['title' => 'Платеж по кредиту']);
    }
}
