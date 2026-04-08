<?php
include 'koneksi.php';

$filter_date    = $_POST['filter_date'] ?? 'hari';   // hari, bulan, tahun, all
$filter_program = $_POST['filter_program'] ?? 'all'; // privat, reguler_materi, reguler_paket, all
$filter_program1 = $_POST['filter_program1'] ?? 'all'; // privat, reguler_materi, reguler_paket, all

// ==========================
// Filter tanggal pendaftar
// ==========================
if ($filter_date === 'hari') {
    $tgl = date('Y-m-d');
    $pen_q = mysqli_query($koneksi, "SELECT COUNT(id_pendaftar) as pen FROM pendaftar WHERE tgl = '$tgl'");
} elseif ($filter_date === 'bulan') {
    $bln = date('Y-m');
    $pen_q = mysqli_query($koneksi, "SELECT COUNT(id_pendaftar) as pen FROM pendaftar WHERE tgl LIKE '$bln%'");
} elseif ($filter_date === 'tahun') {
    $thn = date('Y');
    $pen_q = mysqli_query($koneksi, "SELECT COUNT(id_pendaftar) as pen FROM pendaftar WHERE YEAR(tgl) = '$thn'");
} else {
    $pen_q = mysqli_query($koneksi, "SELECT COUNT(id_pendaftar) as pen FROM pendaftar");
}

// ==========================
// Filter program peserta
// ==========================
$whereProgram = "";
if ($filter_program !== "all") {
    $whereProgram = "WHERE program = '$filter_program'";
}
$pes_q = mysqli_query($koneksi, "SELECT COUNT(id_peserta) as pes FROM peserta $whereProgram");

// ==========================
// Filter program alumni
// ==========================
$whereAlumni = "";
if ($filter_program1 !== "all") {
    $whereAlumni = "WHERE program = '$filter_program1'";
}
$al_q = mysqli_query($koneksi, "SELECT COUNT(id_alumni) as al FROM alumni $whereAlumni");

// ==========================
// Ambil hasil
// ==========================
$pendaftar = mysqli_fetch_assoc($pen_q);
$peserta   = mysqli_fetch_assoc($pes_q);
$alumni    = mysqli_fetch_assoc($al_q);

// Label
$labelTanggal = match($filter_date) {
    "hari"  => "Hari Ini",
    "bulan" => "Bulan Ini",
    "tahun" => "Tahun Ini",
    default => "Semua Waktu"
};

$labelProgram = match($filter_program) {
    "privat"         => "Privat Permateri",
    "reguler_materi" => "Reguler Permateri",
    "reguler_paket"  => "Reguler Paket",
    default          => "Semua Program"
};

$labelProgram1 = match($filter_program1) {
    "privat"         => "Privat Permateri",
    "reguler_materi" => "Reguler Permateri",
    "reguler_paket"  => "Reguler Paket",
    default          => "Semua Program"
};

echo json_encode([
    "pendaftar"    => $pendaftar['pen'] ?? 0,
    "peserta"      => $peserta['pes'] ?? 0,
    "alumni"       => $alumni['al'] ?? 0,
    "labelTanggal" => $labelTanggal,
    "labelProgram" => $labelProgram,
    "labelProgram1" => $labelProgram1   
]);
