<?php

namespace Database\Seeders;

use App\Enums\WorkStatusEnum;
use App\Models\Bike;
use App\Models\Article;
use App\Models\Note;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = User::create([
            'name'     => 'Лука Мудищев',
            'email'    => 'luka@mail.ru',
            'password' => Hash::make('qwerty12'),
            'year'     => 1992,
            'card_id'  => 101,
            'status'   => 1,
        ])->id;


        $bike = Bike::create([
            'owner_id'   => $client,
            'mark_id'    => 22,
            'model'      => 'FZ-1',
            'year'       => 2010,
            'volume'     => 1000,
            'vin'        => 'JDFT546DSF456204',
            'number'     => 'AA 4554 39',
            'additional' => 'Городской мотик на каждый день',
        ])->bike_id;

        Service::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'service_title' => 'Гараж Джи',
            'title'      => 'Подготовка к сезону',
            'work_list'  => 'Перебрали вилку, заменили масло, сальники, пыльники',
            'mileage'    => 43500,
            'price'      => 5000,
            'status'     => WorkStatusEnum::Completed->value,
            'additional' => 'Возникли проблемы с разборкой левого пера',
        ]);

        Service::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'service_title' => 'Делал сам',
            'title'      => 'Подготовка к сезону',
            'work_list'  => 'Заменили передние колодки, жижу, прокачали тормоза',
            'mileage'    => 46350,
            'price'      => 2000,
            'status'     => WorkStatusEnum::InWork->value,
            'additional' => 'Прокачка стандартная, ABS-а нет',
        ]);

        Article::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'article'    => 'A56RET45',
            'title'      => 'Колодки передние',
            'price'      => 3598,
            'additional' => 'Оригинал стоит бешено, берем TRW',
        ]);

        Note::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'title'      => 'Скрип при торможении',
            'additional' => 'Появился скрип при торможении передним тормозом - видимо пора менять колодки.',
            'mileage'    => 46100,
        ]);


        $bike = Bike::create([
            'owner_id'   => $client,
            'mark_id'    => 19,
            'model'      => 'GSXR-750',
            'year'       => 2008,
            'volume'     => 750,
            'vin'        => 'HRTE463JDT937552',
            'number'     => 'AA 4195 39',
            'additional' => 'Мопедка для покатушек в выходные дни по босс-бану до моря',
        ])->bike_id;

        Service::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'service_title' => null,
            'title'      => 'Подготовка к сезону',
            'work_list'  => 'Замена антифриза, масла, фильтров',
            'mileage'    => 39600,
            'price'      => 2500,
            'status'     => WorkStatusEnum::Completed->value,
            'additional' => 'Антифриз подтекает, надо паять радиатор',
        ]);

        Article::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'article'    => 'GT563DF7',
            'title'      => 'Масляный фильтр',
            'price'      => 650,
            'additional' => 'Оригинал не найти, берем Filtron',
        ]);

        Note::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'title'      => 'Кипит в пробке',
            'additional' => 'В пробке стал часто закипать, антифриз не знаю когда менялся.',
            'mileage'    => 39500,
        ]);


        $bike = Bike::create([
            'owner_id'   => $client,
            'mark_id'    => 13,
            'model'      => 'Z900',
            'year'       => 2021,
            'volume'     => 900,
            'vin'        => 'ZKASD21TDR276001',
            'number'     => 'AA 9081 39',
            'additional' => 'Мот заточен под Джи, стоковые звезды и цепь заменены',
        ])->bike_id;

        Service::create([
            'client_id'  => $client,
            'bike_id'    => $bike,
            'service_title' => 'Данияр',
            'title'      => 'Настройка инжектора',
            'work_list'  => null,
            'mileage'    => 20000,
            'price'      => null,
            'status'     => WorkStatusEnum::Planned->value,
            'additional' => 'Сильно завышен CO',
        ]);
    }
}
