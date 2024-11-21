<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreignId('album_id')->nullable()->change(); // Cho phép giá trị null
        });
    }
    
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreignId('album_id')->nullable(false)->change(); // Khôi phục bắt buộc
        });
    }
    
};
