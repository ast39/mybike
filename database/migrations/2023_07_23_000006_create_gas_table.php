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
        Schema::create('gas', function (Blueprint $table) {

            $table->id('record_id')
                ->comment('ID заправки');

            $table->unsignedBigInteger('client_id')
                ->comment('ID владельца');

            $table->unsignedBigInteger('bike_id')
                ->comment('ID мотоцикла');

            $table->string('gas_station')
                ->comment('Название заправки')
                ->nullable()
                ->default(null);

            $table->unsignedInteger('mileage')
                ->comment('Пробег');

            $table->unsignedFloat('volume')
                ->comment('Литры');

            $table->unsignedFloat('price')
                ->comment('Цена');

            $table->text('additional')
                ->comment('Примечание')
                ->nullable()
                ->default(null);

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Заправки автомобилей');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas');
    }
};
