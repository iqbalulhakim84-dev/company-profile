<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$nama_materi = $_POST['nama_materi'] ?? '';
$punya_ujian = $_POST['punya_ujian'] ?? 1; // default 1 (ya)

// Siapkan query dengan prepared statement
$sql = "INSERT INTO materi (nama_materi, punya_ujian) 
        VALUES (?, ?)";
$stmt = $koneksi->prepare($sql);

if ($stmt) {
    // s = string, i = integer, d = double
    $stmt->bind_param("si", $nama_materi, $punya_ujian);

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
            'text'  => 'Data tidak disimpan! Error: ' . $stmt->error
        ];
    }
    $stmt->close();
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text'  => 'Query tidak valid! Error: ' . $koneksi->error
    ];
}

// Redirect kembali ke kelola materi
header("Location: dashboard.php?url=kelola_materi.php");
exit;
