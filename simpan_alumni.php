<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_alumni      = $_POST['id_alumni'];
$nama_lengkap   = $_POST['nama_lengkap'];
$no_induk       = $_POST['no_induk'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$program        = $_POST['program'] ?? null;
$id_jurusan     = $_POST['id_jurusan'] ?? null;
$nama_jurusan     = $_POST['nama_jurusan'] ?? null;
$no_sertifikat  = $_POST['no_sertifikat'];
$no_ujian       = $_POST['no_ujian'];
$tanggal_lulus  = $_POST['tanggal_lulus'];

// Query update
$sql = "UPDATE alumni 
        SET nama_lengkap = ?, 
            no_induk = ?,
            tanggal_lahir = ?,
            program = ?, 
            nama_jurusan = ?, 
            id_jurusan = ?,
            no_sertifikat = ?, 
            no_ujian = ?,
            tanggal_lulus = ?
        WHERE id_alumni = ?";

$stmt = $koneksi->prepare($sql);

if ($stmt) {
    // Binding parameter
    // s = string, i = integer
    $stmt->bind_param(
        "sssssiiisi",
        $nama_lengkap,
        $no_induk,
        $tanggal_lahir,
        $program,
        $nama_jurusan,
        $id_jurusan,     // integer
        $no_sertifikat,
        $no_ujian,
        $tanggal_lulus,
        $id_alumni       // integer
    );

    $execute = $stmt->execute();

    if ($execute) {
        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Data alumni berhasil diedit!'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon'  => 'error',
            'title' => 'Gagal!',
            'text'  => 'Data alumni tidak bisa diedit! Error: ' . $stmt->error
        ];
    }

    $stmt->close();
} else {
    $_SESSION['alert'] = [
        'icon'  => 'error',
        'title' => 'Gagal!',
        'text'  => 'Query tidak bisa dipersiapkan! ' . $koneksi->error
    ];
}

// Redirect kembali ke halaman kelola alumni
header("Location: dashboard.php?url=kelola_alumni.php");
exit;
