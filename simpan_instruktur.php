<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_instruktur = $_POST['id_instruktur'];
$nama_instruktur = $_POST['nama_instruktur'];

$query = "UPDATE instruktur SET nama_instruktur = ? WHERE id_instruktur = ?";

$stmt = $koneksi->prepare($query);

if ($stmt) {
    $stmt->bind_param(
        "si",
        $nama_instruktur,
        $id_instruktur
    );

    $up_instruktur = $stmt->execute();

    if ($up_instruktur) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data berhasil diedit!'
        ];
        header("Location: dashboard.php?url=kelola_instruktur.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal diedit!'
        ];
        header("Location: dashboard.php?url=kelola_instruktur.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal diproses!'
    ];
    header("Location: dashboard.php?url=kelola_instruktur.php");
    exit;
}
