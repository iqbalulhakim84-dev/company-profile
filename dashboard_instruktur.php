<?php
ob_start();
session_start();
include "alert.php";
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION["role"] != 'Instruktur') {
    echo "<script>
        alert('Anda tidak memiliki hak akses');
        document.location.href = 'login.php';
        </script>";
    exit;
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Instruktur</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/cp/logolpkii.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main2.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- Header -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard_instruktur.php" class="logo d-flex align-items-center">
                <img src="assets/img/cp/logolpkii.png" alt="">
                <span class="d-none d-lg-block">Home Admin LPKII</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Icon Pencarian-->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/logolpkii.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['nama']; ?></span>
                    </a><!-- End Gambar Profil -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $_SESSION['nama']; ?></h6>
                            <span><?= $_SESSION['role']; ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Tambahkan menu Edit Profil -->
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="edit_profil.php">
                                <i class="bi bi-person"></i>
                                <span>Edit Profil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="sign_out.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Menu Profil -->
                </li><!-- End Navigasi Profil -->
            </ul>
        </nav><!-- End Navigasi Icon -->
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="dashboard_instruktur.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="?url=kelola_ujian.php">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Kelola Ujian</span>
                </a>
            </li><!-- End Kelola Ujian Nav -->
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <?php
        $url = @$_GET['url'];
        if (!empty($url)) {
            switch ($url) {
                case 'kelola_ujian.php':
                    include 'kelola_ujian.php';
                    break;
                case 'edit_ujian':
                    include 'edit_ujian.php';
                    break;
                case 'detail_ujian':
                    include 'detail_ujian.php';
                    break;
                case 'simpan_nilai':
                    include 'simpan_nilai.php';
                    break;
                case 'hapus_ujian':
                    if (isset($_GET['id_ujian'])) {
                        $id_ujian = intval($_GET['id_ujian']);
                        $query = mysqli_query($koneksi, "DELETE FROM ujian WHERE id_ujian='$id_ujian'");
                        if ($query) {
                            $_SESSION['alert'] = [
                                'icon' => 'success',
                                'title' => 'Berhasil!',
                                'text' => 'Ujian berhasil dihapus!'
                            ];
                            header("Location: dashboard_instruktur.php?url=kelola_ujian.php");
                            exit;
                        } else {
                            $_SESSION['alert'] = [
                                'icon' => 'error',
                                'title' => 'Gagal!',
                                'text' => 'Gagal menghapus Ujian!'
                            ];
                            header("Location: dashboard_instruktur.php?url=kelola_ujian.php");
                            exit;
                        }
                    }
                    break;
                case 'kelola_instruktur.php':
                    include 'kelola_instruktur.php';
                    break;
                case 'edit_instruktur':
                    include 'edit_instruktur.php';
                    break;
                case 'hapus_instruktur':
                    $id_instruktur = $_GET['id_instruktur'];
                    $query = mysqli_query($koneksi, "DELETE FROM instruktur WHERE id_instruktur = '$id_instruktur'");
                    include 'kelola_instruktur.php';
                    break;
                default:
                    echo "Maaf halaman tidak ditemukan!";
                    break;
            }
        } else {
        ?>

            <div class="pagetitle">
                <h1>Dashboard</h1>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    <?php
                    $sql = "
                SELECT COUNT(*) as belum_dinilai
                FROM ujian u
                LEFT JOIN nilai_ujian nu ON nu.id_ujian = u.id_ujian
                WHERE nu.id_ujian IS NULL
            ";
                    // Ambil data Peserta Ujian yang belum Dinilai
                    $nilai_q = mysqli_query($koneksi, $sql);
                    $belum = mysqli_fetch_assoc($nilai_q);
                    ?>

                    <!-- Card Data Ujian yang Belum Dinilai -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Belum Dinilai</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-exclamation-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $belum['belum_dinilai']; ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Siswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card -->
                </div>
            </section>
        <?php } ?>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/utama.js"></script>

</body>
<?php ob_end_flush() ?>

</html>