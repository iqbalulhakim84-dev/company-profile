<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_materi   = $_POST['id_materi'] ?? 0;
$nama_materi = $_POST['nama_materi'] ?? '';
$punya_ujian = $_POST['punya_ujian'] ?? 1; // default 1 (ya)

// Query update pakai prepared statement
$sql = "UPDATE materi SET nama_materi = ?, punya_ujian = ? WHERE id_materi = ?";
$stmt = $koneksi->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sii", $nama_materi, $punya_ujian, $id_materi);

    if ($stmt->execute()) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Data telah Diedit!'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text'  => 'Data gagal diedit! Error: ' . $stmt->error
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

header("Location: dashboard.php?url=kelola_materi.php");
exit;
