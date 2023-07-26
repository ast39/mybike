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
        Schema::create('moto_marks', function (Blueprint $table) {

            $table->id('mark_id')
                ->comment('ID марки');;

            $table->string('title')
                ->comment('Заголовок марки');

            $table->timestamps();

            $table->softDeletes();

            $table->comment('Словарь марок мотоциклов');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moto_marks');
    }
};
