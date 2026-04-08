<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$nama_materi = $_POST['nama_materi'];
$durasi      = $_POST['durasi'];
$harga       = $_POST['harga'];

// Pakai prepared statement
$stmt = $koneksi->prepare("
    INSERT INTO daftar_materi_privat (nama_materi, durasi, harga) 
    VALUES (?, ?, ?)
");

// Bind parameter
// s = string, i = integer, d = double
$stmt->bind_param("ssi", $nama_materi, $durasi, $harga);

if ($stmt->execute()) {
    $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Data berhasil ditambahkan'
    ];
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text'  => 'Data tidak disimpan!'
    ];
}

$stmt->close();
$koneksi->close();

// Redirect
header("Location: dashboard.php?url=kelola_materi_privat.php");
exit;
