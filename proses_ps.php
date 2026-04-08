<?php
session_start();
include "koneksi.php";
include 'alert.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_ajuan   = mysqli_real_escape_string($koneksi, $_POST['id_ajuan']);
    $aksi       = mysqli_real_escape_string($koneksi, $_POST['aksi']);
    $id_peserta = mysqli_real_escape_string($koneksi, $_POST['id_peserta']);

    if ($aksi == "Selesai") {
        $no_sertifikat = mysqli_real_escape_string($koneksi, $_POST['no_sertifikat']);
        $no_induk      = mysqli_real_escape_string($koneksi, $_POST['no_induk']);
        $no_ujian      = mysqli_real_escape_string($koneksi, $_POST['no_ujian']);

        // Update status ajuan
        mysqli_query($koneksi, "
            UPDATE ajuan_sertifikat 
            SET status='Selesai' 
            WHERE id_ajuan='$id_ajuan'
        ");

        // Ambil data peserta
        $q = mysqli_query($koneksi, "SELECT * FROM peserta WHERE id_peserta='$id_peserta'");
        $data = mysqli_fetch_assoc($q);

        // Tentukan jurusan yang benar sesuai program
        $id_jurusan = '';
        if ($data['program'] === 'privat' || $data['program'] === 'reguler_materi') {
            $id_jurusan = $data['id_jurusan'];
        } elseif ($data['program'] === 'reguler_paket') {
            $id_jurusan = $data['id_jurusan'];
        }

        // Pindahkan ke alumni
        mysqli_query($koneksi, "
        INSERT INTO alumni (
            id_peserta, nama_lengkap, tanggal_lahir, program, id_jurusan, 
            tanggal_lulus, no_induk, no_sertifikat, no_ujian
        ) VALUES (
            '{$data['id_peserta']}', '{$data['nama_lengkap']}', '{$data['tanggal_lahir']}', '{$data['program']}', '$id_jurusan',
            NOW(), '$no_induk', '$no_sertifikat', '$no_ujian'
        )
        ");

        // Hapus dari peserta
        mysqli_query($koneksi, "DELETE FROM peserta WHERE id_peserta='$id_peserta'");

        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Peserta dipindahkan ke alumni dan sertifikat disimpan.'
        ];
    } elseif ($aksi == "Ditolak") {
        mysqli_query($koneksi, "
            UPDATE ajuan_sertifikat 
            SET status='Ditolak' 
            WHERE id_ajuan='$id_ajuan'
        ");

        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Ditolak!',
            'text'  => 'Pengajuan sertifikat ditolak.'
        ];
    }

    header("Location: dashboard.php?url=kelola_ajuan_sertifikat.php");
    exit;
}
