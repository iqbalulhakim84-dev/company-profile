<?php
include "koneksi.php";

$keyword = $_POST['keyword'] ?? '';
$param = "%$keyword%";

$stmt = $koneksi->prepare("
    SELECT 
        p.id_peserta, 
        p.nama_lengkap, 
        p.program, 
        p.id_jurusan, 
        p.tanggal_lahir,
        CASE 
            WHEN p.program = 'privat' THEN dp.nama_materi
            WHEN p.program = 'reguler_materi' THEN dr.nama_materi
            WHEN p.program = 'reguler_paket' THEN pk.nama_paket
        END AS nama_jurusan
    FROM peserta p
    LEFT JOIN daftar_materi_privat dp 
        ON (p.program = 'privat' AND p.id_jurusan = dp.id_daftar_materi_privat)
    LEFT JOIN daftar_materi_reguler dr 
        ON (p.program = 'reguler_materi' AND p.id_jurusan = dr.id_daftar_materi_reguler)
    LEFT JOIN paket_kursus pk 
        ON (p.program = 'reguler_paket' AND p.id_jurusan = pk.id_paket_kursus)
    WHERE p.nama_lengkap LIKE ?
    LIMIT 10
");
$stmt->bind_param("s", $param);
$stmt->execute();
$q = $stmt->get_result();

if ($q->num_rows > 0) {
    while ($row = $q->fetch_assoc()) {
        echo "<li class='list-group-item pilih-peserta'
                  data-id='" . ($row['id_peserta'] ?? '') . "'
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
