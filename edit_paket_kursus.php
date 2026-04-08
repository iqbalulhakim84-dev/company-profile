<?php
include 'koneksi.php';
$id_paket_kursus = $_GET['id_paket_kursus'];
$result = mysqli_query($koneksi, "SELECT * FROM paket_kursus WHERE id_paket_kursus='$id_paket_kursus'");
$data = mysqli_fetch_assoc($result);

?>
<div class="pagetitle">
    <h1>Kelola Paket Kursus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_paket_kursus.php">Kelola Paket Kursus</a></li>
            <li class="breadcrumb-item active">Edit Paket Kursus</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Paket Kursus</h5>

        <!-- Horizontal Form -->
        <form method="post" action="simpan_paket_kursus.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="kode" value="<?= $data['kode']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Paket</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="nama_paket" value="<?= $data['nama_paket']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">JP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="jp" value="<?= $data['jp']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="harga" value="<?= $data['harga']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Kode Input</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="kode_jurusan" value="<?= $data['kode_jurusan']; ?>">
                </div>
            </div>
            <div class="text-center">
                <input type="hidden" name="id_paket_kursus" value="<?= $data['id_paket_kursus']; ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->

    </div>
</div>