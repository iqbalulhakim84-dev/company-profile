<?php
include 'koneksi.php';

// Query mengambil data materi paket
$query = "
    SELECT mp.id_materi_paket, pk.nama_paket, m.nama_materi
    FROM materi_paket mp
    INNER JOIN paket_kursus pk ON mp.id_paket_kursus = pk.id_paket_kursus
    INNER JOIN materi m ON mp.id_materi = m.id_materi
";
$result = mysqli_query($koneksi, $query);

// Ambil data Paket Kursus
$paket_q  = mysqli_query($koneksi, "SELECT id_paket_kursus, nama_paket FROM paket_kursus");

// Ambil data Materi
$materi_q = mysqli_query($koneksi, "SELECT * FROM materi");
?>
<div class="pagetitle">
    <h1>Kelola Materi Paket</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Materi Paket</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Materi Paket</h5>

        <!-- Tabel Data Materi Paket -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Nama Materi Paket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($result)) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_paket']; ?></td>
                        <td><?= $data['nama_materi']; ?></td>
                        <td>
                            <a href="?url=hapus_materi_paket&id_materi_paket=<?= $data['id_materi_paket']; ?>" 
                                class="btn btn-danger" onclick="confirmDelete(this)">
                                <i class="bi bi-trash"></i>
                            </a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Materi Paket -->

    </div>
</div>

<!-- Form Tambah Materi Paket -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Materi Paket</h5>

        <!-- Horizontal Form -->
        <form method="post" action="tambah_materi_paket.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Paket</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_paket_kursus" required>
                        <option value="" selected disabled>-- Pilih Paket --</option>
                        <?php while ($paket = mysqli_fetch_assoc($paket_q)) { ?>
                            <option value="<?= $paket['id_paket_kursus'] ?>">
                                <?= $paket['nama_paket'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Materi</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_materi" required>
                        <option value="" selected disabled>-- Pilih Materi --</option>
                        <?php while ($materi = mysqli_fetch_assoc($materi_q)) { ?>
                            <option value="<?= $materi['id_materi'] ?>">
                                <?= $materi['nama_materi'] ?>
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
</div><!-- End Form Tambah Paket -->
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

