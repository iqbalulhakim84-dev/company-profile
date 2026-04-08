<?php
session_start();
include 'koneksi.php';
include "alert.php";

// Ambil data dari form
$id_ujian      = $_POST['id_ujian'] ?? null;
$id_instruktur = $_POST['id_instruktur'] ?? null;
$nilai         = $_POST['nilai'] ?? null;
$id_peserta    = $_POST['id_peserta'] ?? null;

if (!$id_ujian || !$id_instruktur || !$id_peserta || $nilai === null) {
    $_SESSION['alert'] = [
        'icon' => 'warning',
        'title' => 'Data tidak lengkap!',
        'text' => 'Pastikan semua field diisi!'
    ];
    header("Location: dashboard.php?url=detail_ujian.php");
    exit;
}

// --- Cek apakah sudah ada nilai ---
$stmt = $koneksi->prepare("SELECT 1 FROM nilai_ujian WHERE id_ujian = ? AND id_instruktur = ?");
$stmt->bind_param("ii", $id_ujian, $id_instruktur);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['alert'] = [
        'icon' => 'info',
        'title' => 'Sudah Ada!',
        'text'  => 'Nilai untuk ujian ini sudah tersimpan.'
    ];
    $stmt->close();
    header("Location: dashboard.php?url=detail_ujian&id_ujian=$id_ujian");
    exit;
}
$stmt->close();

// --- Insert nilai baru ---
$stmt = $koneksi->prepare("INSERT INTO nilai_ujian (id_ujian, id_instruktur, id_peserta, nilai) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiii", $id_ujian, $id_instruktur, $id_peserta, $nilai); // kalau nilai bisa desimal, ubah jadi "iid"
$query = $stmt->execute();

if ($query) {
    $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Berhasil!',
        'text'  => 'Nilai ujian berhasil disimpan.'
    ];
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text'  => 'Terjadi kesalahan saat menyimpan.'
    ];
}
$stmt->close();

if ($_SESSION['role'] == 'Instruktur') {
    header("Location: dashboard_instruktur.php?url=detail_ujian&id_ujian=$id_ujian");
} else {
    header("Location: dashboard.php?url=detail_ujian&id_ujian=$id_ujian");
}
exit;
