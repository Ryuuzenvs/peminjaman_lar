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
    DB::unprepared("
        CREATE TRIGGER log_peminjaman_baru
        AFTER INSERT ON loans
        FOR EACH ROW
        BEGIN
            INSERT INTO activity_logs (data, created_at, updated_at)
            VALUES (
                CONCAT('Otomatis: Peminjaman baru tercatat untuk Alat ID ', NEW.tool_id, ' oleh Peminjam ID ', NEW.borrower_id),
                NOW(),
                NOW()
            );
        END
    ");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
