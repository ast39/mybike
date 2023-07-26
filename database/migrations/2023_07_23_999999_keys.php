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
        Schema::table('bikes', function(Blueprint $table) {
            $table->foreign('owner_id', 'bike_owner_key')
                ->references('id')
                ->on('users');

            $table->foreign('mark_id', 'bike_mark_key')
                ->references('mark_id')
                ->on('moto_marks');
        });

        Schema::table('works', function(Blueprint $table) {

            $table->foreign('client_id', 'work_client_key')
                ->references('id')
                ->on('users');

            $table->foreign('bike_id', 'work_bike_key')
                ->references('bike_id')
                ->on('bikes');
        });

        Schema::table('articles', function(Blueprint $table) {

            $table->foreign('client_id', 'article_client_key')
                ->references('id')
                ->on('users');

            $table->foreign('bike_id', 'article_bike_key')
                ->references('bike_id')
                ->on('bikes');
        });

        Schema::table('notes', function(Blueprint $table) {

            $table->foreign('client_id', 'note_client_key')
                ->references('id')
                ->on('users');

            $table->foreign('bike_id', 'note_bike_key')
                ->references('bike_id')
                ->on('bikes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bikes', function(Blueprint $table) {
            $table->dropForeign('bike_owner_key');
        });

        Schema::table('works', function(Blueprint $table) {
            $table->dropForeign('work_client_key');
            $table->dropForeign('work_bike_key');
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->dropForeign('article_client_key');
            $table->dropForeign('article_bike_key');
        });

        Schema::table('notes', function(Blueprint $table) {
            $table->dropForeign('note_client_key');
            $table->dropForeign('note_bike_key');
        });
    }
};
