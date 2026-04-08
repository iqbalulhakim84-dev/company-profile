<?php
session_start();
include 'koneksi.php';

$id_daftar_materi_privat = $_POST['id_daftar_materi_privat'];

// Ambil data dari form
$nama_materi = $_POST['nama_materi'];
$durasi = $_POST['durasi'];
$harga = $_POST['harga'];

$query = "UPDATE daftar_materi_privat 
                                SET nama_materi = ?,
                                    durasi = ?,
                                    harga = ? 
                                WHERE id_daftar_materi_privat = ?";

$stmt = $koneksi->prepare($query);
if ($stmt) {
    $stmt->bind_param("sssi", $nama_materi, $durasi, $harga, $id_daftar_materi_privat);

    $up_privat = $stmt->execute();
    if ($up_privat) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data telah Diedit!'
        ];
        header("Location: dashboard.php?url=kelola_materi_privat.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal diedit!'
        ];
        header("Location: dashboard.php?url=kelola_materi_privat.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal dijalankan!'
    ];
    header("Location: dashboard.php?url=kelola_materi_privat.php");
    exit;
}
