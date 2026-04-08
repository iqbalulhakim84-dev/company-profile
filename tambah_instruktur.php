<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$nama_instruktur = $_POST['nama_instruktur'];

$stmt = $koneksi->prepare("INSERT INTO instruktur(nama_instruktur) VALUES (?)");
$stmt->bind_param("s", $nama_instruktur);

if ($stmt->execute()) {
    $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Berhasil!',
        'text' => 'Data berhasil ditambahkan'
    ];
    header("Location: dashboard.php?url=kelola_instruktur.php");
    exit;
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Data tidak disimpan!'
    ];
    header("Location: dashboard.php?url=kelola_instruktur.php");
    exit;
}
$stmt->close();
$koneksi->close();
