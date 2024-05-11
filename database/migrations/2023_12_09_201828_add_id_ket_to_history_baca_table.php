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
        Schema::table('history_baca', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ket')->after('id_buku')->nullable();
            $table->foreign('id_ket')->references('id')->on('ket_buku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_baca', function (Blueprint $table) {
            $table->dropForeign(['id_ket']);
            $table->dropColumn('id_ket');
        });
    }
};
