<?php
include 'koneksi.php';

if (!isset($_GET['id_paket_kursus'])) {
    die("ID Paket Kursus tidak ditemukan.");
}

$id_paket_kursus = $_GET['id_paket_kursus'];

// Ambil detail ujian + nilai
$query = "
    SELECT pk.id_paket_kursus,
       pk.kode,
       pk.nama_paket,
       GROUP_CONCAT(m.nama_materi SEPARATOR ', ') AS daftar_materi,
       pk.jp,
       pk.harga,
       pk.kode_jurusan
FROM paket_kursus pk
LEFT JOIN materi_paket mp ON pk.id_paket_kursus = mp.id_paket_kursus
LEFT JOIN materi m ON mp.id_materi = m.id_materi
WHERE pk.id_paket_kursus = ?
GROUP BY pk.id_paket_kursus, pk.kode, pk.nama_paket, pk.jp, pk.harga, pk.kode_jurusan
ORDER BY pk.nama_paket;
    ";

$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_paket_kursus);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data Paket Kursus tidak ditemukan.");
}
?>
<div class="pagetitle">
    <h1>Kelola Paket Kursus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_paket_kursus.php">Kelola Paket Kursus</a></li>
            <li class="breadcrumb-item active">Detail Paket Kursus</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Paket Kursus</b></h5>

        <!-- Table with stripped rows -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Paket</th>
                    <th>Daftar Materi </th>
                    <th>Jumlah Pertemuan</th>
                    <th>Harga</th>
                    <th>Program</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['kode']; ?></td>
                    <td><?= $data['nama_paket']; ?></td>
                    <td><?= $data['daftar_materi']; ?></td>
                    <td><?= $data['jp']; ?></td>
                    <td><?= '' . number_format($data['harga'], 0, ',', '.'); ?></td>
                    <td><?= $data['kode_jurusan']; ?></td>
                </tr>
            </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div>
</div>