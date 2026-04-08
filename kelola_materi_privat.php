<?php
include 'koneksi.php';

// Ambil data materi privat
$result = mysqli_query($koneksi, "SELECT * FROM daftar_materi_privat");

?>
<div class="pagetitle">
    <h1>Kelola Materi Privat</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Materi Privat</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Materi Privat</h5>

        <!-- Tabel Daftar Materi Privat -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Materi</th>
                    <th>JP</th>
                    <th>Biaya</th>
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
                        <td><?= $data['nama_materi']; ?></td>
                        <td><?= $data['durasi']; ?></td>
                        <td><?= $data['harga']; ?></td>
                        <td>
                            <a href="?url=edit_materi_privat&id_daftar_materi_privat=<?= $data['id_daftar_materi_privat']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_materi_privat&id_daftar_materi_privat=<?= $data['id_daftar_materi_privat']; ?> " class="btn btn-danger" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Daftar Materi Privat -->
    </div>
</div>

<!-- Form Tambah Materi Privat -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Materi Privat</h5>

        <!-- Horizontal Form -->
        <form method="post" action="tambah_materi_privat.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Materi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="nama_materi">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah<br>Pertemuan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="durasi">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="harga">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->
    </div>
</div><!-- End Form Tambah Materi Privat -->
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