<?php
include 'koneksi.php';
$id_instruktur = $_GET['id_instruktur'];
$query = mysqli_query($koneksi, "SELECT * FROM instruktur WHERE id_instruktur = '$id_instruktur'");
$data = mysqli_fetch_assoc($query);

?>
<div class="pagetitle">
    <h1>Kelola Instruktur</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_instruktur.php">Kelola Instruktur</a></li>
            <li class="breadcrumb-item active">Edit Instruktur</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Instruktur</h5>

        <!-- Horizontal Form -->
        <form method="post" action="simpan_instruktur.php">
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Instruktur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="nama_instruktur" value="<?= $data['nama_instruktur']; ?>">
                </div>
            </div>
            <div class="text-center">
                <input type="hidden" name="id_instruktur" value="<?= $data['id_instruktur']; ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->

    </div>
</div>