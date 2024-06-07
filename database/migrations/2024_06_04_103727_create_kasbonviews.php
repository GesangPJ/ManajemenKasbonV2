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
        CREATE VIEW kasbonviews AS
        SELECT
            kasbons.id,
            kasbons.user_id,
            users.name AS user_name,
            kasbons.admin_id,
            admins.name AS admin_name,
            kasbons.jumlah,
            kasbons.metode,
            kasbons.keterangan,
            kasbons.status_r,
            kasbons.status_b,
            kasbons.created_at,
            kasbons.updated_at
        FROM
            kasbons
        JOIN
            users ON kasbons.user_id = users.id
        LEFT JOIN
            users AS admins ON kasbons.admin_id = admins.id AND admins.is_admin = 1;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW kasbonviews');
    }
};
