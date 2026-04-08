<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_paket_kursus = $_POST['id_paket_kursus'];
$kode = $_POST['kode'];
$nama_paket = $_POST['nama_paket'];
$jp = $_POST['jp'];
$harga = $_POST['harga'];

// Pakai prepared statement
$stmt = $koneksi->prepare("
    UPDATE paket_kursus 
    SET kode = ?, nama_paket = ?, jp = ?, harga = ? 
    WHERE id_paket_kursus = ?
");

// Bind parameter
// s = string, i = integer, d = double
$stmt->bind_param("ssssi", $kode, $nama_paket, $jp, $harga, $id_paket_kursus);

if ($stmt->execute()) {
    $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Berhasil!',
        'text' => 'Data berhasil diedit!'
    ];
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Data gagal diedit!'
    ];
}

$stmt->close();
$koneksi->close();

// Redirect
header("Location: dashboard.php?url=kelola_paket_kursus.php");
exit;
