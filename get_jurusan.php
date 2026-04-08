<?php
include "koneksi.php"; // koneksi mysqli

$program = $_GET['program'] ?? '';
$data = [];

switch ($program) {
    case "privat":
        $sql = "SELECT id_daftar_materi_privat AS id, nama_materi AS nama FROM daftar_materi_privat ORDER BY nama_materi";
        break;
    case "reguler_materi":
        $sql = "SELECT id_daftar_materi_reguler AS id, nama_materi AS nama FROM daftar_materi_reguler ORDER BY nama_materi";
        break;
    case "reguler_paket":
        $sql = "SELECT id_paket_kursus AS id, nama_paket AS nama FROM paket_kursus ORDER BY nama_paket";
        break;
    default:
        $sql = "";
}

if ($sql) {
    $result = $koneksi->query($sql);
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
