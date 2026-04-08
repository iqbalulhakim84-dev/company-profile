<?php
include 'koneksi.php';

// Ambil data galeri
$gal_q = mysqli_query($koneksi, "SELECT * FROM galeri");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_galeri'];
    $tipe = $_POST['tipe'];
    $gambar = null;
    $video = null;

    // Jika tipe foto
    if ($tipe === 'foto') {
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $file_tmp  = $_FILES['gambar']['tmp_name'];
            $file_name = pathinfo($_FILES['gambar']['name'], PATHINFO_FILENAME);
            $file_ext  = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

            $new_file_name = $file_name . "_" . time() . ".webp";
            $output_path   = "assets/img/galeri/" . $new_file_name;

            switch ($file_ext) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($file_tmp);
                    break;
                case 'png':
                    $image = imagecreatefrompng($file_tmp);
                    $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                    $white = imagecolorallocate($bg, 255, 255, 255);
                    imagefill($bg, 0, 0, $white);
                    imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                    $image = $bg;
                    break;
                default:
                    $_SESSION['alert'] = [
                        'icon' => 'error',
                        'title' => 'Format tidak didukung',
                        'text'  => 'Gunakan JPG atau PNG untuk foto.'
                    ];
                    header("Location: dashboard.php?url=kelola_galeri.php");
                    exit;
            }

            // Simpan jadi webp
            imagewebp($image, $output_path, 80);
            imagedestroy($image);

            $gambar = $new_file_name;
        }
    }

    // Jika tipe video
    elseif ($tipe === 'video') {
        if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
            $namaFile = uniqid() . "." . $ext;
            move_uploaded_file($_FILES['video']['tmp_name'], "assets/img/galeri/vidio/" . $namaFile);
            $video = $namaFile;
        }
    }

    // Hanya eksekusi INSERT SEKALI SAJA
    if ($gambar || $video) {
        $stmt = $koneksi->prepare("INSERT INTO galeri (nama_galeri, tipe, gambar, video) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $tipe, $gambar, $video);

        if ($stmt->execute()) {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Galeri berhasil ditambahkan!'
            ];

            if ($_SESSION['role'] == 'Admin') {
                header("Location: dashboard.php?url=kelola_galeri.php");
            } elseif ($_SESSION['role'] == 'Petugas') {
                header("Location: dashboard_petugas.php?url=kelola_galeri.php");
            } else {
                header("Location: login.php");
            }
            exit;
        } else {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Gagal menyimpan data!'
            ];
        }
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'File belum diunggah!'
        ];
    }
}
?>


<div class="pagetitle">
    <h1>Kelola Galeri</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Galeri</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Galeri</h5>

        <!-- Tabel Galeri -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Galeri</th>
                    <th width="350">Gambar Galeri</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($gal_q)) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_galeri']; ?></td>
                        <td>
                            <?php if ($data['tipe'] === 'foto'): ?>
                                <img src="assets/img/galeri/<?= $data['gambar']; ?>" class="card-img-top" alt="<?= $data['nama_galeri']; ?>" width="140">
                            <?php else: ?>
                                <video class="w-100" controls>
                                    <source src="assets/img/galeri/vidio/<?= $data['video']; ?>" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="?url=edit_galeri&id_galeri=<?= $data['id_galeri']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_galeri&id_galeri=<?= htmlspecialchars($data['id_galeri']); ?> " class="btn btn-danger" style="font-size: 0.8rem;" onclick="confirmDelete(this)"><i class="bi bi-trash" style="font-size: medium;"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Galeri -->

    </div>
</div>

<!-- Form Tambah Data Galeri -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Galeri</h5>

        <form method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Galeri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_galeri" placeholder="Masukkan Nama Galeri" required>
                </div>
            </div>

            <!-- Pilih Tipe -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tipe</label>
                <div class="col-sm-10">
                    <select class="form-control" name="tipe" id="tipe" required>
                        <option value="foto">Foto</option>
                        <option value="video">Video</option>
                    </select>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="row mb-3" id="uploadFoto">
                <label class="col-sm-2 col-form-label">Upload Gambar</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                </div>
            </div>

            <!-- Upload Video -->
            <div class="row mb-3" id="uploadVideo" style="display:none;">
                <label class="col-sm-2 col-form-label">Upload Video</label>
                <div class="col-sm-10">
                    <input type="file" id="video" name="video" accept="video/*">
                </div>
            </div>

            <!-- Preview -->
            <div class="mb-3 text-center" id="previewWrapper">
                <label class="form-label d-block">Preview Gambar</label>
                <img id="preview" class="img-thumbnail rounded shadow-sm d-block mx-auto"
                    style="max-width:300px; display:none;" alt="Preview Gambar">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form>

    </div>
</div><!-- End Form Tambah Data Galeri -->

<script>
    const tipeSelect = document.getElementById("tipe");
    const uploadFoto = document.getElementById("uploadFoto");
    const uploadVideo = document.getElementById("uploadVideo");
    const previewWrapper = document.getElementById("previewWrapper");

    tipeSelect.addEventListener("change", function() {
        if (this.value === "foto") {
            uploadFoto.style.display = "flex";
            uploadVideo.style.display = "none";
            previewWrapper.style.display = "block";
        } else {
            uploadFoto.style.display = "none";
            uploadVideo.style.display = "flex";
            previewWrapper.style.display = "none";
        }
    });
</script>


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

<!-- Script Preview Gambar-->
<script>
    const inputGambar = document.getElementById("gambar");
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
</script><!-- End Script-->