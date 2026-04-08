<?php
session_start();
include "koneksi.php";
include_once "alert.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_peserta = $_POST['id_peserta'];
    $program    = $_POST['program']; // 'privat', 'reguler_materi', atau 'reguler_paket'
    $id_jurusan = $_POST['id_jurusan']; // id_materi untuk privat/reguler_materi, id_paket_kursus untuk paket

    // 1. Cek apakah peserta benar-benar mengikuti program/materi/paket
    if ($program === 'privat') {
        $stmt = $koneksi->prepare("SELECT 1 FROM peserta WHERE id_peserta=? AND id_jurusan=? AND program='privat' LIMIT 1");
    } elseif ($program === 'reguler_materi') {
        $stmt = $koneksi->prepare("SELECT 1 FROM peserta WHERE id_peserta=? AND id_jurusan=? AND program='reguler_materi' LIMIT 1");
    } elseif ($program === 'reguler_paket') {
        // Paket bisa dari peserta atau alumni
        $stmt = $koneksi->prepare("
            SELECT 1 FROM peserta WHERE id_peserta=? AND id_jurusan=? AND program='reguler_paket'
            UNION
            SELECT 1 FROM alumni WHERE id_peserta=? AND id_jurusan=? AND program='reguler_paket'
            LIMIT 1
        ");
        $stmt->bind_param('ssss', $id_peserta, $id_jurusan, $id_peserta, $id_jurusan);
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Program tidak valid',
            'text' => 'Program peserta tidak dikenali!'
        ];
        header("Location: data_peserta.php?id_peserta=" . urlencode($id_peserta));
        exit;
    }

    if ($program !== 'reguler_paket') {
        $stmt->bind_param('ss', $id_peserta, $id_jurusan);
    }
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Tidak Terdaftar',
            'text' => 'Peserta tidak terdaftar di program/materi/paket ini.'
        ];
        header("Location: data_peserta.php?id_peserta=" . urlencode($id_peserta));
        exit;
    }

    // 2. Cek apakah pengajuan sudah ada
    $cekStmt = $koneksi->prepare("SELECT 1 FROM ajuan_sertifikat WHERE id_peserta=? AND id_jurusan=? AND program=? LIMIT 1");
    $cekStmt->bind_param('sss', $id_peserta, $id_jurusan, $program);
    $cekStmt->execute();
    $cekStmt->store_result();

    if ($cekStmt->num_rows > 0) {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Sudah Pernah Diajukan!',
            'text' => 'Pengajuan sertifikat sudah pernah dilakukan untuk program/materi/paket ini.'
        ];
        header("Location: data_peserta.php?id_peserta=" . urlencode($id_peserta));
        exit;
    }

    // 3. Simpan pengajuan sertifikat baru
    $insertStmt = $koneksi->prepare("
        INSERT INTO ajuan_sertifikat (id_peserta, id_jurusan, program, status, tanggal_pengajuan)
        VALUES (?, ?, ?, 'Proses', NOW())
    ");
    $insertStmt->bind_param('sss', $id_peserta, $id_jurusan, $program);

    if ($insertStmt->execute()) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Sertifikat Diajukan',
            'text' => 'Pengajuan sertifikat berhasil. Tunggu persetujuan dari Admin.'
        ];
        header("Location: data_peserta.php?id_peserta=" . urlencode($id_peserta));
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal Mengajukan',
            'text' => 'Terjadi kesalahan: ' . $koneksi->error
        ];
        header("Location: data_peserta.php?id_peserta=" . urlencode($id_peserta));
        exit;
    }
}
