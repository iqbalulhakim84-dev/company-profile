<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$kode = $_POST['kode'];
$nama_paket = $_POST['nama_paket'];
$jp = $_POST['jp'];
$harga = $_POST['harga'];
$kode_jurusan = $_POST['kode_jurusan'];

$query = "INSERT INTO paket_kursus VALUES ('', ?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($query);
if ($stmt) {
    $stmt->bind_param("sssss", $kode, $nama_paket, $jp, $harga, $kode_jurusan);
    $add_pak = $stmt->execute();
    if ($query) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil ditambahkan'
        ];
        header("Location: dashboard.php?url=kelola_paket_kursus.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Datatidak disimpan!'
        ];
        header("Location: dashboard.php?url=kelola_paket_kursus.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal dijalankan!'
    ];
    header("Location: dashboard.php?url=kelola_paket_kursus.php");
    exit;
}
