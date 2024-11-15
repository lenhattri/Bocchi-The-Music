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
            $table->dropColumn('background_image'); // Xóa cột background_image
            $table->unsignedInteger('plays')->default(0); // Thêm cột plays với mặc định là 0
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->string('background_image')->nullable(); // Khôi phục lại cột background_image
            $table->dropColumn('plays'); // Xóa cột plays khi rollback
        });
    }
};
