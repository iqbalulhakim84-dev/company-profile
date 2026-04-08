<?php
include 'koneksi.php';
// Ambil data Paket Kursus
$result = mysqli_query($koneksi, "SELECT * FROM paket_kursus");
?>
<div class="pagetitle">
    <h1>Kelola Paket Kursus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Paket Kursus</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Paket Kursus</h5>

        <!-- Tabel Daftar Paket Kursus -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <!-- Form Tambah Paket Kursus -->
                    <th>Kode</th>
                    <th>Nama Paket</th>
                    <th>Daftar Materi</th>
                    <th>JP</th>
                    <th>Biaya</th>
                    <th>Program</th>
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
                        <td><?= $data['kode']; ?></td>
                        <td><?= $data['nama_paket']; ?></td>
                        <td><a href="?url=detail_paket_kursus&id_paket_kursus=<?= $data['id_paket_kursus']; ?> ">Selengkapnya...</i></a></td>
                        <td><?= $data['jp']; ?></td>
                        <td><?= '' . number_format($data['harga'], 0, ',', '.'); ?></td>
                        <td><?= $data['kode_jurusan']; ?></td>
                        <td>
                            <a href="?url=edit_paket_kursus&id_paket_kursus=<?= $data['id_paket_kursus']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_paket_kursus&id_paket_kursus=<?= $data['id_paket_kursus']; ?> " class="btn btn-danger" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Daftar Paket Kursus -->
    </div>
</div>

<!-- Form Tambah Paket Kursus -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Paket Kursus</h5>

        <!-- Horizontal Form -->
        <form method="post" action="tambah_paket_kursus.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="kode">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Paket</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="nama_paket">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Jam Pelajaran</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail" name="jp">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail" name="harga">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Input </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="kode_jurusan">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->
    </div>
</div><!-- End Form Tambah Paket Kursus -->
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