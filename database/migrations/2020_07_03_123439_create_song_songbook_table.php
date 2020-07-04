<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongSongbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_songbook', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number');
            $table->foreignId('song_id')->constrained();
            $table->foreignId('songbook_id')->constrained();
            $table->unique(['number', 'song_id', 'songbook_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_songbook');
    }
}
