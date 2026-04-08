<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$username = $_POST['username'] ?? null;
$nama     = $_POST['nama'] ?? null;
$email    = $_POST['email'] ?? null;
$role     = $_POST['role'] ?? null;
$password = $_POST['password'] ?? null;

// Validasi sederhana
if (!$username || !$nama || !$email || !$role || !$password) {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Semua field wajib diisi!'
    ];
    header("Location: tambah_user.php");
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Query tambah user
$query = "INSERT INTO user (username, nama, email, password, role) VALUES (?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($query);

if ($stmt) {
    $stmt->bind_param("sssss", $username, $nama, $email, $hashedPassword, $role);
    $add_acc = $stmt->execute();

    if ($add_acc) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Akun baru berhasil ditambahkan.'
        ];
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Akun gagal ditambahkan!'
        ];
    }
    $stmt->close();
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal dijalankan!'
    ];
}

$koneksi->close();
header("Location: dashboard.php?url=kelola_user.php");
exit;
