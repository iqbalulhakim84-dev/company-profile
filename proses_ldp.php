<?php
session_start();
include 'koneksi.php';
include "alert.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_peserta = mysqli_real_escape_string($koneksi, $_POST['id_peserta'] ?? '');
    $id_alumni = mysqli_real_escape_string($koneksi, $_POST['id_alumni'] ?? '');
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir'] ?? '');


    if (($id_peserta === '' && $id_alumni === '') || $tanggal_lahir === '') {
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Tunggu!',
            'text' => 'Silakan pilih nama peserta dan isi nomor HP!'
        ];
        header("Location: fldp.php");
        exit;
    }

    // Validasi apakah id_peserta & tanggal_lahir cocok
    $q = mysqli_query($koneksi, "SELECT id_peserta FROM peserta WHERE id_peserta='$id_peserta' and tanggal_lahir='$tanggal_lahir' LIMIT 1");
    $row = mysqli_fetch_assoc($q);

    if (!$row) {
        // Kalau tidak ada di peserta → coba alumni
        $q = mysqli_query($koneksi, "SELECT id_alumni FROM alumni WHERE id_alumni='$id_alumni' AND tanggal_lahir='$tanggal_lahir' LIMIT 1");
        $row = mysqli_fetch_assoc($q);
    }


    if ((($row) && $id_peserta != null) && $id_alumni == null || $id_alumni == '') {
        // ✅ Cocok → redirect ke data peserta
        header("Location: data_peserta.php?id_peserta=" . urlencode($row['id_peserta']));
        exit;
    } elseif ((($row) && $id_alumni != null) && $id_peserta == null || $id_peserta == '') {
        header("Location: data_peserta.php?id_alumni=" . urlencode($row['id_alumni']));
        exit;
    } else {
        // ❌ Tidak cocok → tolak
        $_SESSION['alert'] = [
            'icon' => 'warning',
            'title' => 'Gagal!',
            'text' => 'Tanggal Lahir tidak sesuai dengan data peserta!'
        ];
        header("Location: fldp.php");
        exit;
    }
}
