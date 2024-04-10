<?php

use App\Enums\WorkStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {

            $table->id('record_id')
                ->comment('ID записи');

            $table->unsignedBigInteger('client_id')
                ->comment('ID плательщика');

            $table->unsignedBigInteger('bike_id')
                ->comment('ID мотоцикла');

            $table->string('service_title')
                ->nullable()
                ->default(null)
                ->comment('Сервис проводивший работы');

            $table->text('title')
                ->comment('Краткое название работ');

            $table->text('work_list')
                ->nullable()
                ->default(null)
                ->comment('Описание выполненных работ');

            $table->unsignedInteger('mileage')
                ->nullable()
                ->default(null)
                ->comment('Пробег');

            $table->unsignedFloat('price')
                ->nullable()
                ->default(null)
                ->comment('Стоимость работ');

            $table->unsignedTinyInteger('status')
                ->default(WorkStatusEnum::Planned->value)
                ->comment('Статус работ');

            $table->text('additional')
                ->nullable()
                ->default(null)
                ->comment('Заметки');

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Записи проводимых работ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
