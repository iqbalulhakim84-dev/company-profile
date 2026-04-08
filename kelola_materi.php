<?php
include 'koneksi.php';

// Ambil data Materi
$result = mysqli_query($koneksi, "SELECT * FROM materi");

?>
<div class="pagetitle">
    <h1>Kelola Materi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Materi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Materi</h5>

        <!-- Tabel Daftar Materi -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Materi</th>
                    <th>Ujian/Tanpa Ujian</th>
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
                        <td>
                            <?php if($data['punya_ujian']==1){
                                echo "Ujian";
                            } else{
                                echo "Tanpa Ujian";
                            } ?>
                        </td>
                        <td>
                            <a href="?url=edit_materi&id_materi=<?= $data['id_materi']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_materi&id_materi=<?= $data['id_materi']; ?> " class="btn btn-danger" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Daftar Materi -->
    </div>
</div>

<!-- Form Tambah Materi -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Materi</h5>

        <!-- Horizontal Form -->
        <form method="post" action="tambah_materi.php">
            <div class="row mb-3">
                <label for="namaMateri" class="col-sm-2 col-form-label">Nama Materi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaMateri" name="nama_materi" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Punya Ujian?</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="punya_ujian" id="punyaUjianYa" value="1" checked>
                        <label class="form-check-label" for="punyaUjianYa">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="punya_ujian" id="punyaUjianTidak" value="0">
                        <label class="form-check-label" for="punyaUjianTidak">Tidak</label>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->
    </div>
</div><!-- End Form Tambah Materi -->


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