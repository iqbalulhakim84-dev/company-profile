<?php
include 'koneksi.php';
$id_daftar_materi_privat = $_GET['id_daftar_materi_privat'];
$result = mysqli_query($koneksi, "SELECT * FROM daftar_materi_privat WHERE id_daftar_materi_privat='$id_daftar_materi_privat'");
$data = mysqli_fetch_assoc($result);

?>
<div class="pagetitle">
    <h1>Kelola Materi Privat</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_materi_privat.php">Kelola Materi Privat</a></li>
            <li class="breadcrumb-item active">Edit Materi Privat</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Materi Privat</h5>

        <!-- Horizontal Form -->
<form method="post" action="simpan_materi_privat.php">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Nama Materi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_materi" value="<?= $data['nama_materi']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Durasi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="durasi" value="<?= $data['durasi']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="harga" value="<?= $data['harga']; ?>">
        </div>
    </div>
    <div class="text-center">
        <input type="hidden" name="id_daftar_materi_privat" value="<?= $data['id_daftar_materi_privat']; ?>">
        <button type="submit" class="btn btn-primary">Edit</button>
        <button type="reset" class="btn btn-secondary">Kosongkan</button>
    </div>
</form>

    </div>
</div>