<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('song_id')->constrained()->onDelete('cascade'); 
            $table->integer('listen_count')->default(1);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
