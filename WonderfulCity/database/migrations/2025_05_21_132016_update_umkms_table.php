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
        Schema::table('umkms', function (Blueprint $table) {
            if (!Schema::hasColumn('umkms', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('nama_umkm');
            }

            if (!Schema::hasColumn('umkms', 'foto_utama')) {
                $table->string('foto_utama')->nullable()->after('deskripsi');
            }

            if (!Schema::hasColumn('umkms', 'list_foto')) {
                $table->json('list_foto')->nullable()->after('foto_utama');
            }

            if (!Schema::hasColumn('umkms', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('umkms', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['slug', 'foto_utama', 'list_foto', 'created_at', 'updated_at']);
        });
    }
};
