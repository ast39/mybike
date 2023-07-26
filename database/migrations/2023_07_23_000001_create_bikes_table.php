<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bikes', function (Blueprint $table) {

            $table->id('bike_id')
                ->comment('ID байка');

            $table->unsignedBigInteger('owner_id')
                ->comment('Хозяин байка');

            $table->unsignedBigInteger('mark_id')
                ->comment('ID производителя байка');

            $table->string('model')
                ->comment('Модель байка');

            $table->unsignedInteger('year')
                ->comment('Год байка');

            $table->unsignedInteger('volume')
                ->comment('Объем двигателя');

            $table->string('vin')
                ->nullable()
                ->default(null)
                ->comment('VIN байка');

            $table->string('number')
                ->nullable()
                ->default(null)
                ->comment('Гос номер байка');

            $table->text('additional')
                ->nullable()
                ->default(null)
                ->comment('Описание байка');

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Таблица мотоциклов пользователей');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
