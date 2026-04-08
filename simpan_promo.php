<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_promo   = $_POST['id_promo'];
    $nama        = $_POST['nama_promo'];
    $gambar_lama = $_POST['gambar_lama'];

    $gambar_baru = $gambar_lama;

    // Cek apakah ada upload gambar baru
    if (isset($_FILES['gambar_promo']) && $_FILES['gambar_promo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['gambar_promo']['tmp_name'];
        $file_name = pathinfo($_FILES['gambar_promo']['name'], PATHINFO_FILENAME);
        $file_ext  = strtolower(pathinfo($_FILES['gambar_promo']['name'], PATHINFO_EXTENSION));

        $new_file_name = $file_name . "_" . time() . ".webp";
        $output_path   = "assets/img/promo/" . $new_file_name;

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
                echo "<script>alert('Format file tidak didukung. Gunakan JPG atau PNG.');</script>";
                exit;
        }

        // Simpan ke WebP
        imagewebp($image, $output_path, 80);
        imagedestroy($image);

        // Hapus file lama
        $old_file = "assets/img/promo/" . $gambar_lama;
        if (file_exists($old_file)) {
            unlink($old_file);
        }

        $gambar_baru = $new_file_name;
    }

    // Update database
    $stmt = $koneksi->prepare("UPDATE promo SET nama_promo = ?, gambar_promo = ? WHERE id_promo = ?");
    $stmt->bind_param("ssi", $nama, $gambar_baru, $id_promo);
    $query = $stmt->execute();
}
if ($query) {
    if ($_SESSION['role'] == 'Admin') {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Promo berhasil diedit!'
        ];
        header("Location: dashboard.php?url=kelola_promo.php");
        exit;
    } elseif ($_SESSION['role'] == 'Petugas') {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Promo berhasil diedit!'
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
            'text' => 'Gagal mengedit data!'
        ];
        header("Location: dashboard.php?url=kelola_promo.php");
        exit;
    } elseif ($_SESSION['role'] == 'Petugas') {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Gagal mengedit data!'
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
}
