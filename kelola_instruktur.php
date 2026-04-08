<?php
include 'koneksi.php';

// Ambil Data Instruktur
$ins_q = mysqli_query($koneksi, "SELECT * FROM instruktur");
?>
<div class="pagetitle">
    <h1>Kelola Instruktur</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Instruktur</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Instruktur</h5>

        <!-- Tabel Data Instruktur-->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Instruktur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($ins_q)) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_instruktur']; ?></td>
                        <td>
                            <a href="?url=edit_instruktur&id_instruktur=<?= $data['id_instruktur']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_instruktur&id_instruktur=<?= $data['id_instruktur']; ?>" 
                                class="btn btn-danger" 
                                onclick="confirmDelete(this)">
                                <i class="bi bi-trash"></i>
                            </a>


                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Instruktur -->

    </div>
</div>

<!-- Form Tambah Instruktur -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Instruktur</h5>

        <!-- Horizontal Form -->
        <form method="post" action="tambah_instruktur.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Instruktur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="nama_instruktur">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->
    </div>
</div><!-- End Form Tambah Instruktur -->

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
