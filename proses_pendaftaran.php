<?php
session_start();
require 'koneksi.php';
include_once "alert.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil data dari form
  $nisn         = $_POST['nisn'];
  $nik          = $_POST['nik'];
  $nama         = $_POST['namaLengkap'];
  $tempat       = $_POST['tempatLahir'];
  $tgl_lahir    = $_POST['tanggalLahir'];
  $alamat       = $_POST['alamatSekarang'];
  $kodePos      = $_POST['kodePosSekarang'];
  $telp         = $_POST['noTelp'];
  $jk           = $_POST['jenisKelamin'];
  $agama        = $_POST['agama'];
  $pendidikan   = $_POST['pendidikanTerakhir'];
  $tahunLulus   = $_POST['lulusanTahun'];
  $perusahaan   = $_POST['namaPerusahaan'];
  $alamatP      = $_POST['alamatPerusahaan'];
  $kodePosP     = $_POST['kodePosPerusahaan'];
  $telpP        = $_POST['noTelpPerusahaan'];
  $jabatan      = $_POST['jabatan'];
  $ortu         = $_POST['namaOrangTua'];
  $alamatOrtu   = $_POST['alamatOrangTua'];
  $kodePosOrtu  = $_POST['kodePosOrangTua'];
  $telpOrtu     = $_POST['noTelpOrangTua'];

  $program      = $_POST['program'];
  $id_jurusan   = $_POST['id_jurusan'];
  $tgl          = $_POST['tgl'];

  $sql = "INSERT INTO pendaftar (
    nisn, nik, nama_lengkap, tempat_lahir, tanggal_lahir, alamat_sekarang, kode_pos, no_hp, 
    jk, agama, pendidikan_terakhir, lulusan_tahun,
    nama_perusahaan, alamat_perusahaan, kode_pos_perusahaan, no_telp_perusahaan, jabatan,
    nama_orangtua, alamat_orangtua, kode_pos_orangtua, no_telp_orangtua,
    program, id_jurusan, tgl
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $koneksi->prepare($sql);
  $stmt->bind_param(
    "ssssssissssississssissss",
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
    $id_jurusan,
    $tgl
  );

  if ($stmt->execute()) {
    $_SESSION['alert'] = [
      'icon' => 'success',
      'title' => 'Berhasil!',
      'text' => 'Pendaftaran berhasil! Data telah disimpan.'
    ];
    header("Location: pendaftaran.php");
    exit;
  } else {
    $_SESSION['alert'] = [
      'icon' => 'error',
      'title' => 'Gagal!',
      'text' => 'Gagal menyimpan data: ' . addslashes($stmt->error) . ''
    ];
    header("Location: pendaftaran.php");
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
  header("Location: pendaftaran.php");
  exit;
}
