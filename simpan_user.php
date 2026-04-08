<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$id_user  = $_POST['id_user'];
$username = $_POST['username'];
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$role     = $_POST['role'];
$password = $_POST['password'] ?? ''; // kosong kalau tidak diisi

if (!empty($password)) {
    // Jika password diisi → update semua termasuk password
    $sql = "UPDATE user 
            SET username = ?, password = MD5(?), nama = ?, email = ?, role = ? 
            WHERE id_user = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssssi", $username, $password, $nama, $email, $role, $id_user);
} else {
    // Jika password kosong → update tanpa password
    $sql = "UPDATE user 
            SET username = ?, nama = ?, email = ?, role = ? 
            WHERE id_user = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssi", $username, $nama, $email, $role, $id_user);
}

if ($stmt) {
    $execute = $stmt->execute();

    if ($execute) {
        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Data telah Diedit!'
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
        'title' => 'Error!',
        'text'  => 'Query gagal dipersiapkan!'
    ];
}

header("Location: dashboard.php?url=kelola_user.php");
exit;
