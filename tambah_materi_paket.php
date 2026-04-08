<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_paket_kursus = $_POST['id_paket_kursus'];
$id_materi       = $_POST['id_materi'];

$query = "INSERT INTO materi_paket (id_paket_kursus, id_materi) VALUES (?, ?)";
$stmt = $koneksi->prepare($query);
if ($stmt) {
    $stmt->bind_param("ii", $id_paket_kursus, $id_materi);
    $add_matpat = $stmt->execute();
    if ($add_matpat) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil ditambahkan'
        ];
        header("Location: dashboard.php?url=kelola_materi_paket.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data tidak disimpan!'
        ];
        header("Location: dashboard.php?url=kelola_materi_paket.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal dijalankan!'
    ];
    header("Location: dashboard.php?url=kelola_materi_paket.php");
    exit;
}
$stmt->close();
$koneksi->close();
