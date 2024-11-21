<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMusicStyleIdToSongsTable extends Migration
{
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreignId('music_style_id')->nullable()->constrained('music_styles')->onDelete('set null'); // Khóa ngoại đến music_styles
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['music_style_id']);
            $table->dropColumn('music_style_id');
        });
    }
}
