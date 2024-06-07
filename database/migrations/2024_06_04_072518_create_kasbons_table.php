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
        Schema::create('kasbons', function (Blueprint $table) {
            $table->id();    // ID Kasbon
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'posts_user_id'   // ID User
            );
            $table->foreignId('admin_id')->constrained(
                table: 'users', indexName: 'posts_admin_id'  //ID Admin
            );
            $table->integer('jumlah');     //Jumlah Kasbon
            $table->string('metode');      //Metode Bayar Kasbon
            $table->string('keterangan')->nullable();  //Keterangan Kasbon
            $table->string('status_r')->nullable();   //Status persetujuan (Request)
            $table->string('status_b')->nullable();   //Status Bayar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasbons');
    }
};
