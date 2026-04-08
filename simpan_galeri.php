<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_galeri   = $_POST['id_galeri'];
    $nama        = $_POST['nama_galeri'];
    $tipe        = $_POST['tipe'];
    $file_lama   = $_POST['file_lama'];

    $file_baru = $file_lama;

    // ==============================
    // HANDLE UPLOAD GAMBAR
    // ==============================
    if ($tipe === 'gambar' && isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
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
                    'title' => 'Gagal!',
                    'text' => 'Format file tidak didukung. Gunakan JPG atau PNG.'
                ];
                header("Location: dashboard.php?url=kelola_galeri.php");
                exit;
        }

        // Simpan ke WebP
        imagewebp($image, $output_path, 80);
        imagedestroy($image);

        // Hapus file lama
        $old_file = "assets/img/galeri/" . $file_lama;
        if ($file_lama && file_exists($old_file)) {
            unlink($old_file);
        }

        $file_baru = $new_file_name;
    }

    // ==============================
    // HANDLE UPLOAD VIDEO
    // ==============================
    if ($tipe === 'video' && isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['video']['tmp_name'];
        $file_name = pathinfo($_FILES['video']['name'], PATHINFO_FILENAME);
        $file_ext  = strtolower(pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION));

        $new_file_name = $file_name . "_" . time() . "." . $file_ext;
        $output_path   = "assets/video/galeri/" . $new_file_name;

        // Pindahkan file video
        if (move_uploaded_file($file_tmp, $output_path)) {
            // Hapus file lama
            $old_file = "assets/video/galeri/" . $file_lama;
            if ($file_lama && file_exists($old_file)) {
                unlink($old_file);
            }
            $file_baru = $new_file_name;
        }
    }

    // ==============================
    // UPDATE DATABASE
    // ==============================
    if ($tipe === 'gambar') {
        $stmt = $koneksi->prepare("UPDATE galeri SET nama_galeri = ?, gambar = ? WHERE id_galeri = ?");
    } else {
        $stmt = $koneksi->prepare("UPDATE galeri SET nama_galeri = ?, video = ? WHERE id_galeri = ?");
    }

    $stmt->bind_param("ssi", $nama, $file_baru, $id_galeri);
    $query = $stmt->execute();

    // ==============================
    // REDIRECT SESUAI ROLE
    // ==============================
    if ($query) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Galeri berhasil diperbarui!'
        ];

        if ($_SESSION['role'] == 'Admin') {
            header("Location: dashboard.php?url=kelola_galeri.php");
            exit;
        } elseif ($_SESSION['role'] == 'Petugas') {
            header("Location: dashboard_petugas.php?url=kelola_galeri.php");
            exit;
        }
    } else {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Gagal menyimpan galeri!'
        ];

        if ($_SESSION['role'] == 'Admin') {
            header("Location: dashboard.php?url=kelola_galeri.php");
            exit;
        } elseif ($_SESSION['role'] == 'Petugas') {
            header("Location: dashboard_petugas.php?url=kelola_galeri.php");
            exit;
        }
    }
}
