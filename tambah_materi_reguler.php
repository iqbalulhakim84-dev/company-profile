<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$nama_materi = $_POST['nama_materi'];
$durasi = $_POST['durasi'];
$harga = $_POST['harga'];

$query =  "INSERT INTO daftar_materi_reguler VALUES ('', ?, ?, ?)";
$stmt = $koneksi->prepare($query);
if ($stmt) {
    $stmt->bind_param("sss", $nama_materi, $durasi, $harga);
    $add_mat_reg = $stmt->execute();
    if ($add_mat_reg) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil ditambahkan'
        ];
        header("Location: dashboard.php?url=kelola_materi_reguler.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Datatidak disimpan!'
        ];
        header("Location: dashboard.php?url=kelola_materi_reguler.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal dijalankan!'
    ];
    header("Location: dashboard.php?url=kelola_materi_reguler.php");
    exit;
}
$stmt->close();
$koneksi->close();
