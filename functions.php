<?php
// functions.php

function bisa_lulus($koneksi, $id_peserta) {
    // 1. Cek semua ujian sudah ada nilai
    $stmt = $koneksi->prepare("
        SELECT m.id_materi, u.id_ujian, nu.nilai
        FROM materi_paket mp
        JOIN materi m ON mp.id_materi = m.id_materi
        JOIN peserta p ON p.id_paket_kursus = mp.id_paket_kursus
        LEFT JOIN ujian u ON u.id_materi = m.id_materi AND u.id_peserta = p.id_peserta
        LEFT JOIN nilai_ujian nu ON nu.id_ujian = u.id_ujian
        WHERE p.id_peserta = ?
    ");
    $stmt->bind_param('s', $id_peserta);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        if ($row['id_ujian'] === null || $row['nilai'] === null || $row['nilai'] === '') {
            return false; // masih ada materi belum selesai
        }
    }
    $stmt->close();

    // 2. Cek status pengajuan sertifikat sudah "Selesai"
    $stmt2 = $koneksi->prepare("
        SELECT status 
        FROM ajuan_sertifikat 
        WHERE id_peserta = ? 
        ORDER BY tanggal_pengajuan DESC LIMIT 1
    ");
    $stmt2->bind_param('s', $id_peserta);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $ajuan = $res2->fetch_assoc();
    $stmt2->close();

    if (!$ajuan || $ajuan['status'] !== 'Selesai') {
        return false;
    }

    return true;
}
