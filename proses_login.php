<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';
include "alert.php";

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (!$username || !$password) {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Login Gagal',
        'text' => 'Username dan Password wajib diisi!'
    ];
    header("Location: login.php");
    exit;
}

// Ambil user dari database
$query = "SELECT * FROM user WHERE username=? LIMIT 1";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Simpan session
        $_SESSION['id_user']   = $user['id_user'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['nama']      = $user['nama'];
        $_SESSION['role']      = $user['role'];

        // Redirect sesuai role
        if ($user['role'] == "Admin") {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Anda Berhasil Login sebagai Admin!',
                'mode'  => 'toast'
            ];
            header("Location: dashboard.php");
            exit;
        } elseif ($user['role'] == "Petugas") {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Anda Berhasil Login sebagai Petugas!',
                'mode'  => 'toast'
            ];
            header("Location: dashboard_petugas.php");
            exit;
        } elseif ($user['role'] == "Instruktur") {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Anda Berhasil Login sebagai Instruktur!',
                'mode'  => 'toast'
            ];
            header("Location: dashboard_instruktur.php");
            exit;
        } else {
            // Role tidak dikenal
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Login Gagal!',
                'text'  => 'Role tidak dikenali!'
            ];
            header("Location: login.php");
            exit;
        }
    } else {
        // Password salah
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Login Gagal',
            'text'  => 'Username atau Password salah!'
        ];
        header("Location: login.php");
        exit;
    }
} else {
    // Username tidak ditemukan
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Login Gagal',
        'text'  => 'Username tidak ditemukan!'
    ];
    header("Location: login.php");
    exit;
}

$stmt->close();
$koneksi->close();
