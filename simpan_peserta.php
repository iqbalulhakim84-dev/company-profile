<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_peserta     = $_POST['id_peserta'];
$nama_lengkap   = $_POST['nama_lengkap'];
$jk             = $_POST['jk'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$no_hp          = $_POST['no_hp'];
$program        = $_POST['program'];
$id_jurusan     = $_POST['id_jurusan'];
$tanggal_daftar = $_POST['tanggal_daftar'];

// Gunakan prepared statement
$sql = "UPDATE peserta 
        SET nama_lengkap = ?, 
            jk = ?, 
            tanggal_lahir = ?, 
            no_hp = ?, 
            program = ?, 
            id_jurusan = ?, 
            tanggal_daftar = ?
        WHERE id_peserta = ?";

$stmt = $koneksi->prepare($sql);

if ($stmt) {
    // Binding parameter
    // s = string, i = integer
    // binding: s=string, i=integer
    $stmt->bind_param(
        "sssssisi",
        $nama_lengkap,
        $jk,
        $tanggal_lahir,
        $no_hp,
        $program,
        $id_jurusan,    // integer
        $tanggal_daftar,
        $id_peserta     // integer
    );



    $execute = $stmt->execute();

    if ($execute) {
        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Data telah diedit!'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon'  => 'error',
            'title' => 'Gagal!',
            'text'  => 'Data gagal diedit!'
        ];
    }

    $stmt->close();
} else {
    $_SESSION['alert'] = [
        'icon'  => 'error',
        'title' => 'Gagal!',
        'text'  => 'Query tidak bisa dipersiapkan!'
    ];
}

// Redirect sesuai role
if ($_SESSION['role'] == 'Admin') {
    header("Location: dashboard.php?url=kelola_peserta.php");
} elseif ($_SESSION['role'] == 'Petugas') {
    header("Location: dashboard_petugas.php?url=kelola_peserta.php");
} else {
    header("Location: login.php");
}
exit;
