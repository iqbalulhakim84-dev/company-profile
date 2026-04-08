<?php
include "koneksi.php";

$keyword = $_POST['keyword'] ?? '';
$param = "%$keyword%";

$stmt = $koneksi->prepare("
    SELECT 
        a.id_alumni, 
        a.nama_lengkap, 
        a.program, 
        a.id_jurusan, 
        a.tanggal_lahir,
        COALESCE(
            CASE 
                WHEN a.program = 'privat' THEN dp.nama_materi
                WHEN a.program = 'reguler_materi' THEN dr.nama_materi
                WHEN a.program = 'reguler_paket' THEN pk.nama_paket
            END,
            a.nama_jurusan
        ) AS nama_jurusan
    FROM alumni a
    LEFT JOIN daftar_materi_privat dp 
        ON (a.program = 'privat' AND a.id_jurusan = dp.id_daftar_materi_privat)
    LEFT JOIN daftar_materi_reguler dr 
        ON (a.program = 'reguler_materi' AND a.id_jurusan = dr.id_daftar_materi_reguler)
    LEFT JOIN paket_kursus pk 
        ON (a.program = 'reguler_paket' AND a.id_jurusan = pk.id_paket_kursus)
    WHERE a.nama_lengkap LIKE ?
    LIMIT 10
");
$stmt->bind_param("s", $param);
$stmt->execute();
$q = $stmt->get_result();

if ($q->num_rows > 0) {
    while ($row = $q->fetch_assoc()) {
        echo "<li class='list-group-item pilih-alumni'
                  data-idalumni='" . ($row['id_alumni'] ?? '') . "'
                  data-nama='" . htmlspecialchars($row['nama_lengkap']) . "'
                  data-program='" . ($row['program'] ?? '') . "'
                  data-idjurusan='" . ($row['id_jurusan'] ?? '') . "'
                  data-jurusan='" . htmlspecialchars($row['nama_jurusan'] ?? '-') . "'>
                  " . htmlspecialchars($row['nama_lengkap']) . " - <small>" . htmlspecialchars($row['nama_jurusan'] ?? '-') . "</small>
              </li>";
    }
} else {
    echo "<li class='list-group-item text-muted'>Tidak ditemukan</li>";
}

$stmt->close();
$koneksi->close();
