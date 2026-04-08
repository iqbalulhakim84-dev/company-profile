<?php
session_start();
include "koneksi.php";
include "alert.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap   = $_POST['nama_lengkap'];
    $no_induk       = $_POST['no_induk'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $program        = $_POST['program'] ?? null;
    $id_jurusan     = $_POST['id_jurusan'] ?? null;
    $nama_jurusan  = $_POST['nama_jurusan'] ?? NULL;
    $no_sertifikat  = $_POST['no_sertifikat'];
    $no_ujian       = $_POST['no_ujian'];
    $tanggal_lulus  = $_POST['tanggal_lulus'];

    $sql = "
        INSERT INTO alumni (
            nama_lengkap, no_induk, tanggal_lahir, 
            program, nama_jurusan, id_jurusan, no_sertifikat, no_ujian, tanggal_lulus
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $koneksi->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            "sssssiiis",
            $nama_lengkap,
            $no_induk,
            $tanggal_lahir,
            $program,
            $nama_jurusan,
            $id_jurusan,
            $no_sertifikat,
            $no_ujian,
            $tanggal_lulus
        );

        if ($stmt->execute()) {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data alumni berhasil ditambahkan.'
            ];
        } else {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text'  => 'Terjadi kesalahan: ' . $stmt->error
            ];
        }

        $stmt->close();
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text'  => 'Prepare statement gagal: ' . $koneksi->error
        ];
    }

    header("Location: dashboard.php?url=kelola_alumni.php");
    exit;
}
$stmt->close();
$koneksi->close();
