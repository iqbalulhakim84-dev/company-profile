<?php
session_start();
include 'koneksi.php';
include "alert.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_ujian   = (int) $_POST['id_ujian'];
    $tgl_ujian  = $_POST['tgl_ujian'];
    $id_materi  = (int) $_POST['id_materi'];
    $id_peserta = $_POST['id_peserta'];
    $no_pc      = $_POST['no_pc'];
    $ket        = $_POST['ket'];

    $stmt = $koneksi->prepare("
        UPDATE ujian 
        SET tgl_ujian = ?, id_materi = ?, id_peserta = ?, no_pc = ?, ket = ?
        WHERE id_ujian = ?
    ");

    $stmt->bind_param(
        "siissi",
        $tgl_ujian,  // string (s)
        $id_materi,  // int (i)
        $id_peserta, // string (s)
        $no_pc,      // int (i)
        $ket,        // string (s)
        $id_ujian    // int (i)
    );

    $ok = $stmt->execute();

    if ($ok) {
        // ✅ Update berhasil
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Data ujian berhasil diperbarui!'
        ];
    } else {
        // ❌ Update gagal
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text'  => 'Gagal menyimpan data!'
        ];
    }

    // Redirect sesuai role
    if ($_SESSION['role'] == 'Admin') {
        header("Location: dashboard.php?url=kelola_ujian.php");
    } elseif ($_SESSION['role'] == 'Petugas') {
        header("Location: dashboard_petugas.php?url=kelola_ujian.php");
    } elseif ($_SESSION['role'] == 'Instruktur') {
        header("Location: dashboard_instruktur.php?url=kelola_ujian.php");
    } else {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Akses Ditolak!',
            'text' => 'Silakan login kembali.'
        ];
        header("Location: login.php");
    }
    exit;
}
