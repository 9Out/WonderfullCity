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
        Schema::table('umkms', function (Blueprint $table) {
            $table->decimal('rata_rata_harga', 10, 2)->nullable();
            $table->string('nomor_telepon')->nullable();
        });
    }

    public function down()
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['rata_rata_harga', 'nomor_telepon']);
        });
    }

};
