<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel audit_logs terlebih dahulu agar trigger tidak error
        if (!Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->id();
                $table->string('table_name');
                $table->unsignedBigInteger('record_id');
                $table->string('action');
                $table->text('old_value')->nullable();
                $table->text('new_value')->nullable();
                $table->timestamps();
            });
        }

        // 2. Drop existing functions, procedures, and triggers if any
        DB::unprepared("DROP FUNCTION IF EXISTS fn_tingkat_kehadiran;");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_approve_pendaftaran_anggota;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_transaksi_insert;");
        DB::unprepared("DROP TRIGGER IF EXISTS audit_transaksi_kas;");

        // 3. CREATE FUNCTION: fn_tingkat_kehadiran
        DB::unprepared("
            CREATE FUNCTION fn_tingkat_kehadiran(
                p_anggota_id BIGINT,
                p_start_date DATE,
                p_end_date DATE
            ) RETURNS DECIMAL(5,2)
            DETERMINISTIC
            BEGIN
                DECLARE total_kegiatan INT;
                DECLARE total_hadir INT;
                
                SELECT COUNT(*) INTO total_kegiatan
                FROM pendaftaran_kegiatan pk
                JOIN kegiatan k ON pk.kegiatan_id = k.id
                WHERE pk.anggota_id = p_anggota_id
                AND k.tanggal BETWEEN p_start_date AND p_end_date;
                
                SELECT COUNT(*) INTO total_hadir
                FROM absensi a
                JOIN pendaftaran_kegiatan pk ON a.pendaftaran_id = pk.id
                WHERE pk.anggota_id = p_anggota_id
                AND a.status_kehadiran = 'hadir';
                
                IF total_kegiatan = 0 THEN
                    RETURN 0;
                END IF;
                
                RETURN (total_hadir * 100.0) / total_kegiatan;
            END
        ");

        // 4. CREATE STORED PROCEDURE: sp_approve_pendaftaran_anggota
        DB::unprepared("
            CREATE PROCEDURE sp_approve_pendaftaran_anggota(
                IN p_pendaftaran_id BIGINT,
                OUT p_user_id BIGINT,
                OUT p_password_awal VARCHAR(255)
            )
            BEGIN
                DECLARE v_nama VARCHAR(255);
                DECLARE v_nis VARCHAR(50);
                DECLARE v_kelas VARCHAR(20);
                DECLARE v_jurusan VARCHAR(20);
                DECLARE v_role_id BIGINT;
                
                -- Ambil data dari pendaftaran
                SELECT nama, nis, kelas, jurusan 
                INTO v_nama, v_nis, v_kelas, v_jurusan
                FROM pendaftaran_anggota 
                WHERE id = p_pendaftaran_id;
                
                -- Generate password awal (NIS + random string)
                SET p_password_awal = CONCAT(v_nis, '_', SUBSTRING(MD5(RAND()), 1, 6));
                
                -- 1. Insert User baru
                INSERT INTO users (name, email, password, created_at, updated_at)
                VALUES (
                    v_nama, 
                    CONCAT(v_nis, '@sibasket.local'),
                    p_password_awal,
                    NOW(),
                    NOW()
                );
                SET p_user_id = LAST_INSERT_ID();
                
                -- 2. Insert Anggota baru
                INSERT INTO anggota (
                    user_id, nis, nama, kelas, jurusan, 
                    status, tanggal_bergabung, created_at, updated_at
                ) VALUES (
                    p_user_id, v_nis, v_nama, v_kelas, v_jurusan,
                    'aktif', CURDATE(), NOW(), NOW()
                );
                
                -- 3. Update status pendaftaran
                UPDATE pendaftaran_anggota 
                SET status = 'approved', 
                    anggota_id = LAST_INSERT_ID(),
                    updated_at = NOW()
                WHERE id = p_pendaftaran_id;
                
                -- 4. Assign role 'member' ke users via model_has_roles
                SELECT id INTO v_role_id FROM roles WHERE name = 'member' LIMIT 1;
                
                IF v_role_id IS NOT NULL THEN
                    INSERT INTO model_has_roles (role_id, model_type, model_id)
                    VALUES (
                        v_role_id,
                        'App\\Models\\User',
                        p_user_id
                    );
                END IF;
            END
        ");

        // 5. CREATE TRIGGER: audit_transaksi_kas
        DB::unprepared("
            CREATE TRIGGER audit_transaksi_kas
            AFTER UPDATE ON transaksi_kas
            FOR EACH ROW
            BEGIN
                INSERT INTO audit_logs (
                    table_name, 
                    record_id, 
                    action, 
                    old_value, 
                    new_value, 
                    created_at,
                    updated_at
                ) VALUES (
                    'transaksi_kas',
                    NEW.id,
                    'UPDATE',
                    CONCAT('nominal:', OLD.nominal, ' status:', OLD.status),
                    CONCAT('nominal:', NEW.nominal, ' status:', NEW.status),
                    NOW(),
                    NOW()
                );
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS fn_tingkat_kehadiran;");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_approve_pendaftaran_anggota;");
        DB::unprepared("DROP TRIGGER IF EXISTS after_transaksi_insert;");
        DB::unprepared("DROP TRIGGER IF EXISTS audit_transaksi_kas;");
        
        Schema::dropIfExists('audit_logs');
    }
};