<?php
session_start();
require 'koneksi.php';
include_once "alert.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil data dari form
  $id_pendaftar = $_POST['id_pendaftar'];

  $nisn         = $_POST['nisn'] ?? null;
  $nik          = $_POST['nik'] ?? null;
  $nama         = $_POST['nama_lengkap'];
  $tempat       = $_POST['tempat_lahir'];
  $tgl_lahir    = $_POST['tanggal_lahir'];
  $alamat       = $_POST['alamat'] ?? null;
  $kodePos      = $_POST['kodePosSekarang'] ?? null;
  $telp         = $_POST['no_hp'] ?? null;
  $jk           = $_POST['jk'] ?? null;
  $agama        = $_POST['agama'] ?? null;
  $pendidikan   = $_POST['pendidikan_terakhir'] ?? null;
  $tahunLulus   = $_POST['lulusan_tahun'] ?? null;
  $perusahaan   = $_POST['nama_perusahaan'] ?? null;
  $alamatP      = $_POST['alamatPerusahaan'] ?? null;
  $kodePosP     = $_POST['kodePosPerusahaan'] ?? null;
  $telpP        = $_POST['noTelpPerusahaan'] ?? null;
  $jabatan      = $_POST['jabatan'] ?? null;
  $ortu         = $_POST['namaIbu'] ?? null;
  $alamatOrtu   = $_POST['alamatOrangTua'] ?? null;
  $kodePosOrtu  = $_POST['kodePosOrangTua'] ?? null;
  $telpOrtu     = $_POST['noTelpOrangTua'] ?? null;

  $program      = $_POST['program'];
  if ($program === 'privat') {
    $jurusan = $_POST['id_daftar_materi_privat'] ?? null;
  } elseif ($program === 'reguler_materi') {
    $jurusan = $_POST['id_daftar_materi_reguler'] ?? null;
  } elseif ($program === 'reguler_paket') {
    $jurusan = $_POST['id_paket_kursus'] ?? null;
  }
  $tgl          = $_POST['tgl'];

  $sql = "UPDATE pendaftar SET
    nisn = ?, nik = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, alamat_sekarang = ?, kode_pos = ?, no_hp = ?,
    jk = ?, agama = ?, pendidikan_terakhir = ?, lulusan_tahun = ?,
    nama_perusahaan = ?, alamat_perusahaan = ?, kode_pos_perusahaan = ?, no_telp_perusahaan = ?, jabatan = ?,
    nama_orangtua = ?, alamat_orangtua = ?, kode_pos_orangtua = ?, no_telp_orangtua = ?,
    program = ?, id_jurusan = ?, tgl = ?
    WHERE id_pendaftar = ?";

  $stmt = $koneksi->prepare($sql);
  $stmt->bind_param(
    "ssssssissssississssissssi",
    $nisn,
    $nik,
    $nama,
    $tempat,
    $tgl_lahir,
    $alamat,
    $kodePos,
    $telp,
    $jk,
    $agama,
    $pendidikan,
    $tahunLulus,
    $perusahaan,
    $alamatP,
    $kodePosP,
    $telpP,
    $jabatan,
    $ortu,
    $alamatOrtu,
    $kodePosOrtu,
    $telpOrtu,
    $program,
    $jurusan,
    $tgl,
    $id_pendaftar
  );

  if ($stmt->execute()) {
    $_SESSION['alert'] = [
      'icon' => 'success',
      'title' => 'Berhasil!',
      'text' => 'Data pendaftar berhasil diperbarui.'
    ];
    header("Location: dashboard.php?url=kelola_pendaftar.php");
    exit;
  } else {
    $_SESSION['alert'] = [
      'icon' => 'error',
      'title' => 'Gagal!',
      'text' => 'Gagal mengupdate data: ' . addslashes($stmt->error)
    ];
    header("Location: dashboard.php?url=kelola_pendaftar.php");
    exit;
  }

  $stmt->close();
  $koneksi->close();
} else {
  $_SESSION['alert'] = [
    'icon' => 'warning',
    'title' => 'Akses Ditolak',
    'text' => 'Akses tidak valid!'
  ];
  header("Location: dashboard.php?url=kelola_pendaftar.php");
  exit;
}
