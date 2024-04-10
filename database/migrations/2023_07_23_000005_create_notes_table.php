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
        Schema::create('notes', function (Blueprint $table) {

            $table->id('note_id')
                ->comment('ID записи');;

            $table->unsignedBigInteger('client_id')
                ->comment('ID автора');

            $table->unsignedBigInteger('bike_id')
                ->comment('ID байка');

            $table->string('title')
                ->comment('Заголовок заметки');

            $table->text('additional')
                ->comment('Текст заметки');

            $table->unsignedInteger('mileage')
                ->nullable()
                ->default(0)
                ->comment('Пробег');

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Заметки пользователя о мотоцикле');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
