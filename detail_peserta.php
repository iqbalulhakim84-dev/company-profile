<?php
include 'koneksi.php';

if (!isset($_GET['id_peserta'])) die("ID peserta tidak ditemukan.");
$id_peserta = $_GET['id_peserta'];

// Cek dulu di peserta aktif
// Ambil data peserta/alumni dasar dulu
$stmt = $koneksi->prepare("
    SELECT p.*, pn.*, 'peserta' AS sumber
    FROM peserta p
    JOIN pendaftar pn ON p.id_pendaftar = pn.id_pendaftar
    WHERE p.id_peserta = ?
");
$stmt->bind_param("i", $id_peserta);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Kalau peserta tidak ada, cek alumni
if (!$data) {
    $stmt = $koneksi->prepare("
        SELECT a.*, pn.*, 'alumni' AS sumber
        FROM alumni a
        JOIN pendaftar pn ON a.nama_lengkap = pn.nama_lengkap
        WHERE a.id_peserta = ?
    ");
    $stmt->bind_param("i", $id_peserta);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Ambil nama jurusan sesuai program
if ($data['program'] === 'privat') {
    $stmt = $koneksi->prepare("SELECT nama_materi AS nama_jurusan FROM daftar_materi_privat WHERE id_daftar_materi_privat = ?");
    $stmt->bind_param("i", $data['id_jurusan']);
} elseif ($data['program'] === 'reguler_materi') {
    $stmt = $koneksi->prepare("SELECT nama_materi AS nama_jurusan FROM daftar_materi_reguler WHERE id_daftar_materi_reguler = ?");
    $stmt->bind_param("i", $data['id_jurusan']);
} else { // reguler_paket
    $stmt = $koneksi->prepare("SELECT nama_paket AS nama_jurusan FROM paket_kursus WHERE id_paket_kursus = ?");
    $stmt->bind_param("i", $data['id_jurusan']);
}
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$namaJurusan = $row['nama_jurusan'] ?? '-';
$stmt->close();


if (!$data) die("Data peserta tidak ditemukan.");

// Ambil nama jurusan/materi jika program selain reguler_paket
if ($data['program'] == 'privat') {
    $stmt = $koneksi->prepare("SELECT nama_materi AS nama_jurusan FROM daftar_materi_privat WHERE id_daftar_materi_privat = ?");
    $stmt->bind_param("i", $data['id_jurusan']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $namaJurusan = $row['nama_jurusan'] ?? '-';
} elseif ($data['program'] == 'reguler_materi') {
    $stmt = $koneksi->prepare("SELECT nama_materi AS nama_jurusan FROM daftar_materi_reguler WHERE id_daftar_materi_reguler = ?");
    $stmt->bind_param("i", $data['id_jurusan']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $namaJurusan = $row['nama_jurusan'] ?? '-';
} else {
    $namaJurusan = $data['nama_paket'] ?? '-';
}
?>

<div class="pagetitle">
    <h1>Detail Peserta</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_ajuan_sertifikat.php">Kelola Pengajuan Sertifikat</a></li>
            <li class="breadcrumb-item active">Detail Peserta</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Pengaju <b>: <?= $data['nama_lengkap']; ?></b></h5>
        <ul>
            <li><b>NISN :</b> <?= $data['nisn']; ?></li>
            <li><b>NIK :</b> <?= $data['nik']; ?></li>
            <li><b>Nama Lengkap :</b> <?= $data['nama_lengkap']; ?></li>
            <li><b>Tempat Lahir :</b> <?= $data['tempat_lahir']; ?></li>
            <li><b>Tanggal Lahir :</b> <?= $data['tanggal_lahir']; ?></li>
            <li><b>Alamat Sekarang :</b> <?= $data['alamat_sekarang']; ?></li>
            <li><b>Kode Pos Sekarang :</b> <?= $data['kode_pos']; ?></li>
            <li><b>No. Telp :</b> <?= $data['no_hp']; ?></li>
            <li><b>Jenis Kelamin :</b> <?= $data['jk']; ?></li>
            <li><b>Agama :</b> <?= $data['agama']; ?></li>
            <li><b>Pendidikan Terakhir :</b> <?= $data['pendidikan_terakhir']; ?></li>
            <li><b>Lulusan Tahun :</b> <?= $data['lulusan_tahun']; ?></li>
            <li><b>Nama Perusahaan :</b> <?= $data['nama_perusahaan']; ?></li>
            <li><b>Alamat Perusahaan :</b> <?= $data['alamat_perusahaan']; ?></li>
            <li><b>Kode Pos Perusahaan :</b> <?= $data['kode_pos_perusahaan']; ?></li>
            <li><b>No. Telp Perusahaan :</b> <?= $data['no_telp_perusahaan']; ?></li>
            <li><b>Jabatan :</b> <?= $data['jabatan']; ?></li>
            <li><b>Nama Orang Tua/ Wali :</b> <?= $data['nama_orangtua']; ?></li>
            <li><b>Alamat Orang Tua / Wali :</b> <?= $data['alamat_orangtua']; ?></li>
            <li><b>Kode Pos Orang Tua / Wali :</b> <?= $data['kode_pos_orangtua']; ?></li>
            <li><b>No. Telp Orang Tua / Wali :</b> <?= $data['no_telp_orangtua']; ?></li>
            <li><b>Program :</b> <?= $data['program']; ?></li>
            <li><b>Jurusan :</b> <?= $namaJurusan ?></li>
            <li><b>Tgl Daftar :</b> <?= $data['tgl']; ?></li>
        </ul>   
    </div>
</div>