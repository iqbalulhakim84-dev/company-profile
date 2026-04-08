<?php
session_start();
include 'koneksi.php';

$nama_lengkap     = $_POST['nama_lengkap'];
$tanggal_lahir    = $_POST['tanggal_lahir'];
$id_materi        = $_POST['id_materi'];
$tgl_ujian        = $_POST['tgl_ujian'];
$no_pc            = $_POST['no_pc'];
$ket              = $_POST['ket'];                      

// 1. Validasi peserta berdasarkan nama dan tanggal lahir
$query_peserta = "SELECT id_peserta FROM peserta WHERE nama_lengkap = ? AND tanggal_lahir = ?";
$stmt_peserta = $koneksi->prepare($query_peserta);
$stmt_peserta->bind_param("ss", $nama_lengkap, $tanggal_lahir);
$stmt_peserta->execute();
$result = $stmt_peserta->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_peserta = $row['id_peserta']; // gunakan id asli dari database

    // 2. Insert ke tabel ujian
    $query = "INSERT INTO ujian (tgl_ujian, id_materi, id_peserta, no_pc, ket) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("siiss", $tgl_ujian, $id_materi, $id_peserta, $no_pc, $ket);

    if ($stmt->execute()) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Ujian berhasil ditambahkan!'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Gagal mengirim data ujian!'
        ];
    }
} else {
    // Jika tidak ditemukan peserta
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Validasi Gagal!',
        'text' => 'Nama dan tanggal lahir tidak cocok dengan data peserta!'
    ];
}

header("Location: form_ujian.php");
exit;
