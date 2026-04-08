<?php
session_start();
include 'koneksi.php';
include "alert.php";

if (isset($_GET['id_pendaftar'])) {
    $id_pendaftar = $_GET['id_pendaftar'];

    // ambil data pendaftar
    $stmt = $koneksi->prepare("SELECT * FROM pendaftar WHERE id_pendaftar=?");
    $stmt->bind_param("i", $id_pendaftar);
    $stmt->execute();
    $result = $stmt->get_result();
    $pendaftar = $result->fetch_assoc();

    if ($pendaftar) {
        // simpan ke tabel peserta
        $stmt2 = $koneksi->prepare("INSERT INTO peserta (id_pendaftar, id_jurusan, nama_lengkap, jk, tanggal_lahir, no_hp, program, tanggal_daftar)
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param(
            "iissssss",
            $pendaftar['id_pendaftar'],
            $pendaftar['id_jurusan'],
            $pendaftar['nama_lengkap'],
            $pendaftar['jk'],
            $pendaftar['tanggal_lahir'],
            $pendaftar['no_hp'],
            $pendaftar['program'],
            $pendaftar['tgl']
        );
        if ($stmt2->execute()) {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Pendaftar berhasil dijadidkan Peserta!'
            ];
            header("Location: dashboard.php?url=kelola_pendaftar.php");
            exit;
        } else {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Gagal menyetujui pendaftar!'
            ];
            header("Location: dashboard.php?url=kelola_pendaftar.php");
            exit;
        }
    } else {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Kesalahan!',
            'text' => 'Data pendaftar tidak ditemukan!'
        ];
        header("Location: dashboard.php?url=kelola_pendaftar.php");
        exit;
    }
}
