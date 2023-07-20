<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persediaans', function (Blueprint $table) {
            $table->id();
            $table->timestamp("tanggal")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string("stok_awal");
            $table->string("produk_masuk");
            $table->integer("produk_keluar");
            $table->string("stok_akhir");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaans');
    }
};
