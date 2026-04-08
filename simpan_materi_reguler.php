<?php
session_start();
include 'koneksi.php';

$id_daftar_materi_reguler = $_POST['id_daftar_materi_reguler'];

// Ambil data dari form
$nama_materi = $_POST['nama_materi'];
$durasi = $_POST['durasi'];
$harga = $_POST['harga'];

$query = "UPDATE daftar_materi_reguler 
                                SET nama_materi = ?, 
                                    durasi = ?, 
                                    harga = ? 
                                WHERE id_daftar_materi_reguler = ?";

$stmt = $koneksi->prepare($query);
if ($stmt) {
    $stmt->bind_param("sssi", $nama_materi, $durasi, $harga, $id_daftar_materi_reguler);
    $up_reg_mat = $stmt->execute();
    if ($up_reg_mat) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data telah Diedit!'
        ];
        header("Location: dashboard.php?url=kelola_materi_reguler.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal diedit!'
        ];
        header("Location: dashboard.php?url=kelola_materi_reguler.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal diproses!'
    ];
    header("Location: dashboard.php?url=kelola_materi_privat.php");
    exit;
}
