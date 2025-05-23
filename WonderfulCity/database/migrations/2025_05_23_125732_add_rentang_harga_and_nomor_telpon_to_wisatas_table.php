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
        Schema::table('wisatas', function (Blueprint $table) {
            $table->json('rentang_harga')->nullable();
            $table->string('nomor_telepon')->nullable();
        });
    }

    public function down()
    {
        Schema::table('wisatas', function (Blueprint $table) {
            $table->dropColumn(['rentang_harga', 'nomor_telepon']);
        });
    }
};
