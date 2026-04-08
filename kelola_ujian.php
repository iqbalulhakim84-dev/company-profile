<?php
include 'koneksi.php';

// Ambil Data Ujian dengan Data Peserta dan Materi Ujian
$uji_q = mysqli_query($koneksi, "SELECT 
    u.id_ujian,
    u.id_peserta,
    COALESCE(p.nama_lengkap, a.nama_lengkap) AS nama_peserta,
    u.id_materi,
    CASE
        WHEN pe.program = 'privat' THEN dp.nama_materi
        WHEN pe.program = 'reguler_materi' THEN dr.nama_materi
        WHEN pe.program = 'reguler_paket' THEN m.nama_materi
        ELSE '-'
    END AS nama_materi,
    u.tgl_ujian,
    u.no_pc,
    u.ket,
    nu.nilai,
    pe.program
FROM ujian u
LEFT JOIN peserta p ON u.id_peserta = p.id_peserta
LEFT JOIN alumni a ON u.id_peserta = a.id_peserta
LEFT JOIN nilai_ujian nu ON nu.id_ujian = u.id_ujian

LEFT JOIN (
    SELECT id_peserta, program, id_jurusan FROM peserta
    UNION
    SELECT id_peserta, program, id_jurusan FROM alumni
) pe ON u.id_peserta = pe.id_peserta

LEFT JOIN daftar_materi_privat dp ON pe.program='privat' AND u.id_materi = dp.id_daftar_materi_privat
LEFT JOIN daftar_materi_reguler dr ON pe.program='reguler_materi' AND u.id_materi = dr.id_daftar_materi_reguler
LEFT JOIN materi m ON pe.program='reguler_paket' AND u.id_materi = m.id_materi

ORDER BY u.tgl_ujian DESC;
");
?>
<div class="pagetitle">
    <h1>Kelola Ujian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home_admin.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Ujian</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Ujian</h5>

        <!-- Tabel Data Ujian -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Materi Ujian</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($uji_q)) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_peserta']; ?></td>
                        <td><?= $data['nama_materi']; ?></td>
                        <td><?= $data['nilai'] !== null ? $data['nilai'] : '<i>Belum ada nilai</i>' ?></td>
                        <td>
                            <a href="?url=detail_ujian&id_ujian=<?= $data['id_ujian']; ?> " class="btn btn-warning"><i class="bi bi-eye"></i></a> |
                            <a href="?url=edit_ujian&id_ujian=<?= $data['id_ujian']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_ujian&id_ujian=<?= $data['id_ujian']; ?> " class="btn btn-danger" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Data Ujian -->

    </div>
</div>

<?php

// Ambil data Materi
$materi_q = mysqli_query($koneksi, "SELECT * FROM materi ORDER BY nama_materi ASC");

// Ambil data Peserta
$peserta_q = mysqli_query($koneksi, "SELECT * FROM peserta ORDER BY nama_lengkap ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tgl   = $_POST['tgl_ujian'];
    $id_materi = $_POST['id_materi'];

    $stmt = $koneksi->prepare("INSERT INTO ujian (tgl_ujian, id_materi) VALUES (?, ?)");
    $stmt->bind_param("sis", $tgl, $id_materi);
    $query = $stmt->execute();

    if ($query) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Ujian berhasil ditambahkan!'
        ];
        header("Location: dashboard.php?url=kelola_ujian.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data ujian gagal disimpan!'
        ];
        header("Location: dashboard.php?url=kelola_ujian.php");
        exit;
    }
}
?>

<!-- Form Tambah Data Ujian -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Ujian</h5>

        <form method="post" action="tambah_ujian.php">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <select class="form-control" id="id_peserta" name="id_peserta" required>
                        <option value="" selected disabled>-- Pilih Peserta --</option>
                        <?php while ($peserta = mysqli_fetch_assoc($peserta_q)) { ?>
                            <option value="<?= $peserta['id_peserta'] ?>">
                                <?= $peserta['nama_lengkap'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Materi Ujian</label>
                <div class="col-sm-10">
                    <select class="form-control" id="id_materi" name="id_materi" required>
                        <option value="" selected disabled>-- Pilih Materi --</option>
                        <!-- Materi akan diisi otomatis via JS -->
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Ujian</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_ujian" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No PC</label>
                <div class="col-sm-10">
                    <select class="form-control" name="no_pc" required>
                        <option value="" selected disabled>-- Pilih No PC --</option>
                        <?php for ($i = 1; $i <= 14; $i++) { ?>
                            <option value="PC-<?= $i ?>">PC-<?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <select class="form-control" name="ket" required>
                        <option value="" selected disabled>-- Pilih Keterangan Ujian--</option>
                        <option value="Ujian Pertama">Ujian Pertama</option>
                        <option value="Remedial">Remedial</option>
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Ambil materi sesuai peserta via AJAX
    document.getElementById('id_peserta').addEventListener('change', function() {
        let pesertaId = this.value;
        let materiSelect = document.getElementById('id_materi');

        // reset dulu
        materiSelect.innerHTML = '<option value="" selected disabled>-- Pilih Materi --</option>';

        fetch('get_materi.php?id_peserta=' + pesertaId)
            .then(response => response.json())
            .then(data => {
                data.forEach(m => {
                    let opt = document.createElement('option');
                    opt.value = m.id_materi;
                    opt.textContent = m.nama_materi;
                    materiSelect.appendChild(opt);
                });
            });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(el) {
        event.preventDefault(); // cegah redirect langsung
        let href = el.getAttribute('href'); // ambil URL dari tombol

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus permanen dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    }
</script>