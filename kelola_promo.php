<?php
include 'koneksi.php';

// Ambil data promo
$pro_q = mysqli_query($koneksi, "SELECT * FROM promo");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = $_POST['nama_promo'];

    if (isset($_FILES['gambar_promo']) && $_FILES['gambar_promo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['gambar_promo']['tmp_name'];
        $file_name = pathinfo($_FILES['gambar_promo']['name'], PATHINFO_FILENAME);
        $file_ext  = strtolower(pathinfo($_FILES['gambar_promo']['name'], PATHINFO_EXTENSION));

        $new_file_name = $file_name . "_" . time() . ".webp";
        $output_path   = "assets/img/promo/" . $new_file_name;

        // Buat resource image sesuai tipe
        switch ($file_ext) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($file_tmp);
                break;
            case 'png':
                $image = imagecreatefrompng($file_tmp);
                // hilangkan background transparan jadi putih
                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                $white = imagecolorallocate($bg, 255, 255, 255);
                imagefill($bg, 0, 0, $white);
                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                $image = $bg;
                break;
            default:
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Format Tidak Didukung!',
                    'text' => 'Gunakan JPG atau PNG!'
                ];
                header("Location: dashboard.php?url=kelola_promo.php");
                exit;
        }

        // Simpan sebagai webp
        imagewebp($image, $output_path, 80);
        imagedestroy($image);

        // Simpan ke DB
        $stmt = $koneksi->prepare("INSERT INTO promo (nama_promo, gambar_promo) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $new_file_name);
        $query = $stmt->execute();

        if ($query) {
            if ($_SESSION['role'] == 'Admin') {
                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Promo berhasil ditambahkan!'
                ];
                header("Location: dashboard.php?url=kelola_promo.php");
                exit;
            } elseif ($_SESSION['role'] == 'Petugas') {
                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Promo berhasil ditambahkan!'
                ];
                header("Location: dashboard_petugas.php?url=kelola_promo.php");
                exit;
            } else {
                $_SESSION['alert'] = [
                    'icon' => 'warning',
                    'title' => 'Akses Ditolak!',
                    'text' => 'Silakan login kembali.'
                ];
                header("Location: login.php");
                exit;
            }
        } else {
            if ($_SESSION['role'] == 'Admin') {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Gagal menyimpan data!'
                ];
                header("Location: dashboard.php?url=kelola_promo.php");
                exit;
            } elseif ($_SESSION['role'] == 'Petugas') {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Gagal menyimpan data!'
                ];
                header("Location: dashboard_petugas.php?url=kelola_promo.php");
                exit;
            } else {
                $_SESSION['alert'] = [
                    'icon' => 'warning',
                    'title' => 'Akses Ditolak!',
                    'text' => 'Silakan login kembali.!'
                ];
                header("Location: login.php");
                exit;
            }
        }
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Upload Gagal!',
            'text' => 'Pastikan memilih file Gambar.'
        ];
        header("Location: dashboard.php?url=kelola_promo.php");
        exit;
    }
}

?>
<div class="pagetitle">
    <h1>Kelola Promo</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Promo</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Promo</h5>

        <!-- Tabel Data Promo -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Promo</th>
                    <th>Gambar Promo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($pro_q)) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_promo']; ?></td>
                        <td><img src="assets/img/promo/<?= $data['gambar_promo'] ?>" width="200"></td>
                        <td>
                            <a href="?url=edit_promo&id_promo=<?= $data['id_promo']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_promo&id_promo=<?= $data['id_promo']; ?>"
                                class="btn btn-danger"
                                onclick="confirmDelete(this)">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Data Promo -->
    </div>
</div>

<!-- Form Tambah Data Promo -->
<div class="card">
    <div class="card-body ">
        <h5 class="card-title">Tambah Promo</h5>

        <form method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Promo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_promo" placeholder="Masukkan Nama Promo" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Upload Gambar</label>
                <div class="col-sm-10">
                    <input type="file" id="gambar_promo" name="gambar_promo" accept=".jpg,.jpeg,.png" required>
                </div>
            </div>

            <!-- Preview -->
            <div class="mb-3 text-center">
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
</div><!-- End Form Tambah Data Promo -->

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

<!-- Script Preview Gambar -->
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