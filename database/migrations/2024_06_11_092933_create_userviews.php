<?php
/**
 * Migration untuk VIEW Kasbon, ditampilkan di Dashboard Admin
 * Terdiri dari tabel kasbons, users, admins
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE VIEW userviews AS
        SELECT
            *
        FROM
            users;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW userviews');
    }
};
