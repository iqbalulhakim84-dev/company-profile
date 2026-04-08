<?php
include 'koneksi.php';
$id_galeri = $_GET['id_galeri'];
$query = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id_galeri = '$id_galeri'");
$data = mysqli_fetch_assoc($query);
?>

<div class="pagetitle">
    <h1>Kelola Galeri</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_galeri.php">Kelola Galeri</a></li>
            <li class="breadcrumb-item active">Edit Galeri</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Galeri</h5>

        <!-- Form Edit -->
        <form method="post" action="simpan_galeri.php" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Galeri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_galeri" 
                           value="<?= $data['nama_galeri']; ?>" required>
                </div>
            </div>

            <?php if ($data['tipe'] == 'gambar') : ?>
                <!-- Upload Gambar -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Upload Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">
                        <p class="small text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <label class="form-label d-block">Preview Gambar</label>
                    <img id="preview" src="assets/img/galeri/<?= $data['gambar']; ?>" 
                         class="img-thumbnail rounded shadow-sm d-block mx-auto"
                         style="max-width:300px;" alt="Preview Gambar">
                </div>

            <?php elseif ($data['tipe'] == 'video') : ?>
                <!-- Upload Video -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Upload Video</label>
                    <div class="col-sm-10">
                        <input type="file" id="video" name="video" accept=".mp4,.webm,.ogg">
                        <p class="small text-muted">Biarkan kosong jika tidak ingin mengganti video.</p>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <label class="form-label d-block">Preview Video</label>
                    <video id="previewVideo" class="rounded shadow-sm d-block mx-auto" 
                           style="max-width:300px;" controls>
                        <source src="assets/video/galeri/<?= $data['video']; ?>" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>
            <?php endif; ?>

            <div class="text-center">
                <input type="hidden" name="id_galeri" value="<?= $data['id_galeri']; ?>">
                <input type="hidden" name="tipe" value="<?= $data['tipe']; ?>">
                <input type="hidden" name="file_lama" 
                       value="<?= $data['tipe'] == 'gambar' ? $data['gambar'] : $data['video']; ?>">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Form -->

    </div>
</div>

<script>
    // Preview Gambar
    const inputGambar = document.getElementById("gambar");
    const preview = document.getElementById("preview");
    if (inputGambar) {
        inputGambar.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Preview Video
    const inputVideo = document.getElementById("video");
    const previewVideo = document.getElementById("previewVideo");
    if (inputVideo) {
        inputVideo.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                previewVideo.querySelector("source").src = url;
                previewVideo.load();
            }
        });
    }
</script>
