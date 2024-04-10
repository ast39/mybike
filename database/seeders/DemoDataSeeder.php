<?php

namespace Database\Seeders;

use App\Enums\WorkStatusEnum;
use App\Models\Bike;
use App\Models\Article;
use App\Models\Note;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Джи-Механик',
            'email'    => 'service@gy.ru',
            'password' => Hash::make('gyService39'),
            'email_verified_at' => Carbon::now(),
        ]);

        $user = User::create([
            'name'     => 'Водитель',
            'email'    => 'demo@mail.ru',
            'password' => Hash::make('demo'),
            'email_verified_at' => Carbon::now(),
        ])->id;

        $shiver = Bike::create([
            'owner_id'   => $user,
            'mark_id'    => 1,
            'model'      => 'Shiver',
            'year'       => 2012,
            'volume'     => 750,
            'vin'        => 'DGFYHDTR435432',
            'number'     => 'AA3434 39',
            'additional' => 'Городской мот',
        ])->bike_id;

        Note::create([
            'client_id'  => $user,
            'bike_id'     => $shiver,
            'title'      => 'Покупка',
            'additional' => 'Сегодня приобрел мот и переоформил',
            'mileage'    => 9082,
        ]);

        $hd = Bike::create([
            'owner_id'   => $user,
            'mark_id'    => 9,
            'model'      => 'Electra Glide',
            'year'       => 1998,
            'volume'     => 1450,
            'vin'        => 'TRFGCHFT543452',
            'number'     => 'AA7774 39',
            'additional' => 'Для путешествий',
        ])->bike_id;

        Note::create([
            'client_id'  => $user,
            'bike_id'     => $hd,
            'title'      => 'Покупка',
            'additional' => 'Сегодня приобрел мот и переоформил',
            'mileage'    => 24580,
        ]);

        Note::create([
            'client_id'  => $user,
            'bike_id'     => $hd,
            'title'      => 'Первая поломка',
            'additional' => 'Сегодня проткнул колесо, записался на шиномонтаж',
            'mileage'    => 24754,
        ]);

        Service::create([
            'client_id'     => $user,
            'bike_id'        => $hd,
            'service_title' => 'Ашот Сервис',
            'title'         => 'Диагностика',
            'work_list'     => 'Колесо залатали.',
            'mileage'       => 124782,
            'price'         => 1500,
            'status'        => WorkStatusEnum::Completed,
            'additional'    => 'Рад, что ничего серьезного',
        ]);

        Note::create([
            'client_id'  => $user,
            'bike_id'     => $hd,
            'title'      => 'Скрип при торможении',
            'additional' => 'Сегодня начался скрип при торможении',
            'mileage'    => 25102,
        ]);

        Service::create([
            'client_id'     => $user,
            'bike_id'        => $hd,
            'service_title' => 'Васген Сервис',
            'title'         => 'Замена колодок',
            'work_list'     => 'Выполнена замена передних тормозных колодок',
            'mileage'       => 25186,
            'price'         => 2000,
            'status'        => WorkStatusEnum::Completed,
            'additional'    => '',
        ]);

        Article::create([
            'client_id'  => $user,
            'bike_id'     => $hd,
            'article'    => '34116780711',
            'title'      => 'Тормозные колодки - фронт',
            'price'      => 5985,
            'additional' => 'Колодки TRW',
        ]);

        Note::create([
            'client_id'  => $user,
            'bike_id'     => $hd,
            'title'      => 'Наблюдения',
            'additional' => 'Накатал почти первую свою тысячу, пока доволен',
            'mileage'    => 25473,
        ]);
    }
}
