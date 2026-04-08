<?php
session_start();
include 'koneksi.php';
$nama_lengkap = $_POST['nama_lengkap'];
$id_materi = $_POST['id_materi'];
$tgl_ujian = $_POST['tgl_ujian'];
$id_peserta = $_POST['id_peserta'];
$no_pc = $_POST['no_pc'];
$ket = $_POST['ket'];

$query = "INSERT INTO ujian 
    (tgl_ujian, id_materi, id_peserta, no_pc, ket) 
    VALUES 
    (?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($query);
if ($stmt) {
    $stmt->bind_param("siiss", $tgl_ujian, $id_materi, $id_peserta, $no_pc, $ket);

    $add_stud_asg = $stmt->execute();

    if ($add_stud_asg) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Ujian berhasil ditambahkan!'
        ];
        header("Location: dashboard.php?url=kelola_ujian.php");
        exit;
        
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Gagal mengirim data ujian'
        ];
        header("Location: dashboard.php?url=kelola_ujian.php");
        exit;
    }
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Gagal!',
        'text' => 'Query gagal dijalankan!'
    ];
    header("Location: dashboard.php?url=kelola_ujian.php");
    exit;
}
