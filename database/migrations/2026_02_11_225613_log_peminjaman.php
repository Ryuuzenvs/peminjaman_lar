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
        // dr if ext
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_log_activity");
        DB::unprepared("
        CREATE PROCEDURE sp_log_activity(IN pesan TEXT)
        BEGIN
            INSERT INTO activity_logs (data, created_at, updated_at)
            VALUES (pesan, NOW(), NOW());
        END
    ");
        // beg {} end
        // ev triger with call
        // 	Mendefinisikan parameter input (IN) bernama pesan dengan tipe data TEXT untuk stored procedure.

        // dr if ext
        DB::unprepared("DROP FUNCTION IF EXISTS hitung_denda");
        DB::unprepared("
        CREATE FUNCTION hitung_denda(tgl_pinjam DATETIME, tgl_kembali DATETIME) 
        RETURNS INT
        DETERMINISTIC
        BEGIN
            DECLARE selisih INT;
            DECLARE denda INT DEFAULT 0;
            
            SET selisih = DATEDIFF(tgl_kembali, tgl_pinjam);
            
            IF selisih > 3 THEN
                SET denda = (selisih - 3) * 1000;
            END IF;
            
            RETURN denda;
        END
    ");
        // ret must a int
        // be {} end
        // 

        DB::unprepared("DROP TRIGGER IF EXISTS log_peminjaman_baru");
        DB::unprepared("
        CREATE TRIGGER log_peminjaman_baru 
        AFTER INSERT ON loans FOR EACH ROW
        BEGIN
            CALL sp_log_activity(CONCAT('Otomatis: Peminjaman baru alat ID ', NEW.tool_id));
        END
    ");
        DB::unprepared("DROP FUNCTION IF EXISTS hitung_diskon");
        DB::unprepared("
    CREATE FUNCTION hitung_diskon(total_harga INT) 
    RETURNS INT
    DETERMINISTIC
    BEGIN
        DECLARE potongan INT DEFAULT 0;
            IF total_harga > 100000 THEN
            SET potongan = total_harga * 0.1;
        END IF;
        
        RETURN potongan;
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
