<?php
include 'koneksi.php';
$id_promo = $_GET['id_promo'];
$query = mysqli_query($koneksi, "SELECT * FROM promo WHERE id_promo = '$id_promo'");
$data = mysqli_fetch_assoc($query);
// Ambil daftar file gambar dari folder ../assets/img
$files = array_diff(scandir("assets/img/promo"), ['.', '..']);
?>

<div class="pagetitle">
    <h1>Kelola Promo</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_promo.php">Kelola Promo</a></li>
            <li class="breadcrumb-item active">Edit Promo</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Promo</h5>

        <!-- Horizontal Form -->
        <form method="post" enctype="multipart/form-data" action="simpan_promo.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Promo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="nama_promo" value="<?= $data['nama_promo']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Upload Gambar</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar_promo" name="gambar_promo" accept=".jpg,.jpeg,.png" required>
                </div>
            </div>
            <div class="mb-3 text-center">
                <label class="form-label d-block">Preview Gambar</label>
                <img id="preview" class="img-thumbnail rounded shadow-sm d-block mx-auto"
                    style="max-width:300px; display:none;" alt="Preview Gambar">
            </div>

            <div class="text-center">
                <input type="hidden" name="id_promo" value="<?= $data['id_promo']; ?>">
                <input type="hidden" name="gambar_lama" value="<?= $data['gambar_promo']; ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->

    </div>
</div>

<script>
    const inputGambar = document.getElementById("gambar_promo");
    const preview = document.getElementById("preview");

    inputGambar.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.display = "block";
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = "none";
            preview.src = "";
        }
    });
</script><!-- End Script -->