<?php
include 'koneksi.php';
include "alert.php";

if (!isset($_GET['id_ujian'])) {
    die("ID Ujian tidak ditemukan.");
}

$id_ujian = $_GET['id_ujian'];

// Ambil detail ujian + nilai
$query = "
    SELECT u.id_ujian, u.tgl_ujian, u.id_peserta, u.no_pc, u.ket,
           p.nama_lengkap, p.id_peserta, p.program, p.id_jurusan,
           COALESCE(mp.nama_materi, mr.nama_materi, m.nama_materi) AS nama_materi,
           n.nilai, i.nama_instruktur
    FROM ujian u
    JOIN peserta p ON u.id_peserta = p.id_peserta
    LEFT JOIN daftar_materi_privat mp 
           ON (p.program = 'privat' AND u.id_materi = mp.id_daftar_materi_privat)
    LEFT JOIN daftar_materi_reguler mr 
           ON (p.program = 'reguler_materi' AND u.id_materi = mr.id_daftar_materi_reguler)
    LEFT JOIN paket_kursus pk 
           ON (p.program = 'reguler_paket' AND p.id_jurusan = pk.id_paket_kursus)
    LEFT JOIN materi m ON u.id_materi = m.id_materi
    LEFT JOIN nilai_ujian n ON u.id_ujian = n.id_ujian
    LEFT JOIN instruktur i ON n.id_instruktur = i.id_instruktur
    WHERE u.id_ujian = ?
";

$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_ujian);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data ujian tidak ditemukan.");
}
?>
<div class="pagetitle">
    <h1>Kelola Ujian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_ujian.php">Kelola Ujian</a></li>
            <li class="breadcrumb-item active">Detail Ujian</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll">
        <h5 class="card-title">Data Nilai Ujian <b><?= $data['nama_lengkap']; ?></b></h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th width=150>Nama</th>
                    <th width=200>Materi Ujian</th>
                    <th width=135>Tanggal Ujian</th>
                    <th width=100>No PC</th>
                    <th width=50>Ket</th>
                    <th width=100>Nilai Ujian</th>
                    <th width=120>Dinilai Oleh</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['nama_lengkap']; ?></td>
                    <td><?= $data['nama_materi']; ?></td>
                    <td><?= $data['tgl_ujian']; ?></td>
                    <td><?= $data['no_pc']; ?></td>
                    <td><?= $data['ket']; ?></td>
                    <td><?= $data['nilai'] !== null ? $data['nilai'] : '<i>Belum ada nilai</i>' ?></td>
                    <td><?= $data['nama_instruktur']; ?></td>
                </tr>
            </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div>
</div>
<?php
$ujian_q = mysqli_query($koneksi, "
    SELECT u.id_ujian, p.nama_lengkap, m.nama_materi, u.tgl_ujian, u.id_peserta
    FROM ujian u
    JOIN peserta p ON u.id_peserta = p.id_peserta
    JOIN materi m ON u.id_materi = m.id_materi
");
$peserta_q = mysqli_query($koneksi, "SELECT * FROM peserta");
$instruktur_q = mysqli_query($koneksi, "SELECT * FROM instruktur");
?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Berikan Nilai Ujian <b><?= $data['nama_lengkap']; ?><b></h5>

        <!-- Horizontal Form -->
        <form method="post" action="?url=simpan_nilai&id_ujian=<?= $data['id_ujian']; ?>">
            <input type="hidden" name="id_ujian" value="<?= $data['id_ujian'] ?>">
            <input type="hidden" name="id_peserta" value="<?= $data['id_peserta'] ?>">
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPassword" name="nilai">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Instruktur</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_instruktur" required>
                        <option value="" disabled selected>-- Pilih Instruktur --</option>
                        <?php while ($instruktur = mysqli_fetch_assoc($instruktur_q)) { ?>
                            <option value="<?= $instruktur['id_instruktur'] ?>">
                                <?= $instruktur['nama_instruktur'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->

    </div>
</div>