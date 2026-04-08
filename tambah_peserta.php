<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$jk = $_POST['jk'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$no_hp = $_POST['no_hp'];
$program = $_POST['program'];
$id = $_POST['id_jurusan'];
$tanggal_daftar = $_POST['tanggal_daftar'];

// Simpan ke database
$stmt = $koneksi->prepare("INSERT INTO peserta (nama_lengkap, jk, tanggal_lahir, no_hp, program, id_jurusan, tanggal_daftar) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $nama_lengkap, $jk, $tanggal_lahir, $no_hp, $program, $id, $tanggal_daftar);


// Ambil role dari akun yang sedang login
$id_akun = $_SESSION['id_akun']; // pastikan Anda simpan id_akun saat login

$cekRole = $koneksi->query("SELECT role FROM akun WHERE id_akun = '$id_akun'");
$row = $cekRole->fetch_assoc();
$role = $row['role'];

if ($stmt->execute()) {
    if ($_SESSION['role'] == 'Admin') {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Peserta berhasil ditambahkan!'
        ];
        header("Location: dashboard.php?url=kelola_peserta.php");
        exit;
    } elseif ($_SESSION['role'] == 'Petugas') {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Peserta berhasil ditambahkan!'
        ];
        header("Location: dashboard_petugas.php?url=kelola_peserta.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Akses Ditolak!',
            'text' => 'Silakan login kembali.'
        ];
        header("Location: login.php");
        exit;
    }
} else {
    if ($_SESSION['role'] == 'Admin') {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Gagal menyimpan data!'
        ];
        header("Location: dashboard.php?url=kelola_peserta.php");
        exit;
    } elseif ($_SESSION['role'] == 'Petugas') {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Gagal menyimpan data!'
        ];
        header("Location: dashboard_petugas.php?url=kelola_peserta.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Akses Ditolak!',
            'text' => 'Silakan login kembali.'
        ];
        header("Location: login.php");
        exit;
    }
}
