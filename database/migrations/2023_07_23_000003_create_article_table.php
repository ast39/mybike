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
        Schema::create('articles', function (Blueprint $table) {

            $table->id('article_id')
                ->comment('ID записи');

            $table->unsignedBigInteger('client_id')
                ->comment('ID автора');

            $table->unsignedBigInteger('bike_id')
                ->comment('ID байка');

            $table->string('article')
                ->comment('Артикул запчасти');

            $table->string('title')
                ->comment('Название запчасти');

            $table->unsignedFloat('price')
                ->comment('Средняя цена');

            $table->text('additional')
                ->nullable()
                ->default(null)
                ->comment('Заметки');

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Артикулы запчастей мотоцикла');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
