<?php
session_start();
include 'koneksi.php';
include "alert.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_peserta = $_POST['id_peserta'] ?? '';
    $id_alumni  = $_POST['id_alumni'] ?? '';
    $no_induk   = $_POST['no_induk'] ?? '';

    if (($id_peserta === '' && $id_alumni === '') || $no_induk === '') {
        $_SESSION['alert'] = [
            'icon'  => 'warning',
            'title' => 'Tunggu!',
            'text'  => 'Silakan pilih nama peserta dan isi Nomor Induk!'
        ];
        header("Location: fldp.php");
        exit;
    }

    $row = null;

    // ✅ Cek di tabel peserta
    if ($id_peserta !== '') {
        $stmt = $koneksi->prepare("SELECT id_peserta FROM peserta WHERE id_peserta = ? AND no_induk = ? LIMIT 1");
        $stmt->bind_param("is", $id_peserta, $no_induk);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    }

    // ✅ Kalau tidak ada, cek di tabel alumni
    if (!$row && $id_alumni !== '') {
        $stmt = $koneksi->prepare("SELECT id_alumni FROM alumni WHERE id_alumni = ? AND no_induk = ? LIMIT 1");
        $stmt->bind_param("is", $id_alumni, $no_induk);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    }

    // ✅ Jika cocok, arahkan ke halaman data
    if ($row) {
        if (!empty($row['id_peserta'])) {
            header("Location: data_peserta.php?id_peserta=" . urlencode($row['id_peserta']));
            exit;
        } elseif (!empty($row['id_alumni'])) {
            header("Location: data_peserta.php?id_alumni=" . urlencode($row['id_alumni']));
            exit;
        }
    }

    // ❌ Jika tidak cocok
    $_SESSION['alert'] = [
        'icon'  => 'warning',
        'title' => 'Gagal!',
        'text'  => 'Nomor Induk tidak sesuai dengan data Alumni!'
    ];
    header("Location: fldp.php");
    exit;
}
