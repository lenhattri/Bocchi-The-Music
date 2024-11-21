<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicStylesTable extends Migration
{
    public function up()
    {
        Schema::create('music_styles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tên phong cách nhạc
            $table->text('description')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('music_styles');
    }
}
