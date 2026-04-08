<?php
// get_materi.php
require 'koneksi.php';
$id_peserta = $_GET['id_peserta'] ?? '';

$materiList = [];

// Ambil program peserta
$stmt_prog = $koneksi->prepare(
    "SELECT p.program, p.id_jurusan
     FROM peserta p
     WHERE p.id_peserta = ?
     UNION
     SELECT a.program, a.id_jurusan
     FROM alumni a
     WHERE a.id_peserta = ?"
);
$stmt_prog->bind_param('ss', $id_peserta, $id_peserta);
$stmt_prog->execute();
$res_prog = $stmt_prog->get_result();

if($res_prog && $row = $res_prog->fetch_assoc()){
    $program = $row['program'];
    $idJurusan = $row['id_jurusan'];

    if($program === 'privat'){
        $q = $koneksi->prepare("SELECT id_daftar_materi_privat AS id_materi, nama_materi FROM daftar_materi_privat WHERE id_daftar_materi_privat = ?");
        $q->bind_param('s', $idJurusan);
    } elseif($program === 'reguler_materi'){
        $q = $koneksi->prepare("SELECT id_daftar_materi_reguler AS id_materi, nama_materi FROM daftar_materi_reguler WHERE id_daftar_materi_reguler = ?");
        $q->bind_param('s', $idJurusan);
    } elseif($program === 'reguler_paket'){
        $q = $koneksi->prepare(
            "SELECT m.id_materi, m.nama_materi
             FROM materi_paket mp
             JOIN materi m ON mp.id_materi = m.id_materi
             WHERE mp.id_paket_kursus = ?"
        );
        $q->bind_param('s', $idJurusan);
    }

    $q->execute();
    $res = $q->get_result();
    while($m = $res->fetch_assoc()){
        $materiList[] = $m;
    }
}

header('Content-Type: application/json');
echo json_encode($materiList);
