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
        Schema::create('payments', function (Blueprint $table) {

            $table->id('payment_id')
                ->comment('ID платежа');

            $table->unsignedBigInteger('type_id')
                ->comment('ID категории платежа');

            $table->unsignedBigInteger('client_id')
                ->comment('ID владельца');

            $table->unsignedBigInteger('bike_id')
                ->comment('ID мотоцикла');

            $table->string('title')
                ->comment('Название платежа')
                ->nullable()
                ->default(null);

            $table->unsignedInteger('mileage')
                ->comment('Пробег');

            $table->unsignedFloat('price')
                ->comment('Цена');

            $table->text('additional')
                ->comment('Примечание')
                ->nullable()
                ->default(null);

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Платежи по автомобилю');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
