<?php
ob_start();
session_start();
include "alert.php";
if (!isset($_SESSION['role'])) {
    $_SESSION['alert'] = [
        'icon' => 'warning',
        'title' => 'Akses Ditolak!',
        'text' => 'Anda tidak memiliki hak akses!'
    ];
    header("Location: login.php");
    exit;
}
if ($_SESSION["role"] != 'Petugas') {
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

    <title>Dashboard - LKP LPKII</title>
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
            <a href="dashboard_petugas.php" class="logo d-flex align-items-center">
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
                <a class="nav-link " href="dashboard_petugas.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="?url=kelola_pendaftar.php">
                    <i class="bi bi-person"></i>
                    <span>Kelola Pendaftar</span>
                </a>
            </li><!-- End Kelola Pendaftar Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="?url=kelola_peserta.php">
                    <i class="bi bi-people"></i>
                    <span>Kelola Peserta Kursus</span>
                </a>
            </li><!-- End Kelola Peserta Kursus Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="?url=kelola_alumni.php">
                    <i class="bi bi-award"></i>
                    <span>Kelola Alumni</span>
                </a>
            </li><!-- End Kelola Promo Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="?url=kelola_ujian.php">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Kelola Ujian</span>
                </a>
            </li><!-- End Kelola Galeri Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="?url=kelola_ajuan_sertifikat.php">
                    <i class="bi bi-file-earmark-check"></i>
                    <span>Pengajuan Sertifikat</span>
                </a>
            </li><!-- End Kelola Galeri Nav -->
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <?php
        $url = @$_GET['url'];
        if (!empty($url)) {
            switch ($url) {

                case 'kelola_pendaftar.php':
                    include 'kelola_pendaftar.php';
                    break;
                case 'edit_pendaftar':
                    include 'edit_pendaftar.php';
                    break;
                case 'hapus_pendaftar':
                    if (isset($_GET['id_pendaftar'])) {
                        $id_pendaftar = intval($_GET['id_pendaftar']);
                        $query = mysqli_query($koneksi, "DELETE FROM pendaftar WHERE id_pendaftar='$id_pendaftar'");
                        if ($query) {
                            $_SESSION['alert'] = [
                                'icon' => 'success',
                                'title' => 'Berhasil!',
                                'text' => 'Pendaftar berhasil dihapus!'
                            ];
                            header("Location: dashboard.php?url=kelola_pendaftar.php");
                            exit;
                        } else {
                            $_SESSION['alert'] = [
                                'icon' => 'error',
                                'title' => 'Gagal!',
                                'text' => 'Gagal menghapus Pendaftar!'
                            ];
                            header("Location: dashboard.php?url=kelola_pendaftar.php");
                            exit;
                        }
                    }
                    break;

                case 'kelola_peserta.php':
                    include 'kelola_peserta.php';
                    break;
                case 'edit_peserta':
                    include 'edit_peserta.php';
                    break;
                case 'hapus_peserta':
                    if (isset($_GET['id_peserta'])) {
                        $id_peserta = intval($_GET['id_peserta']);
                        mysqli_query($koneksi, "DELETE FROM ajuan_sertifikat WHERE id_peserta='$id_peserta'");
                        $query = mysqli_query($koneksi, "DELETE FROM peserta WHERE id_peserta='$id_peserta'");
                        if ($query) {
                            $_SESSION['alert'] = [
                                'icon' => 'success',
                                'title' => 'Berhasil!',
                                'text' => 'Peserta berhasil dihapus!'
                            ];
                            header("Location: dashboard.php?url=kelola_peserta.php");
                            exit;
                        } else {
                            $_SESSION['alert'] = [
                                'icon' => 'error',
                                'title' => 'Gagal!',
                                'text' => 'Gagal menghapus Peserta!'
                            ];
                            header("Location: dashboard.php?url=kelola_peserta.php");
                            exit;
                        }
                    }
                    break;
                case 'kelola_alumni.php':
                    include 'kelola_alumni.php';
                    break;
                case 'edit_alumni':
                    include 'edit_alumni.php';
                    break;
                case 'hapus_alumni':
                    if (isset($_GET['id_alumni'])) {
                        $id_alumni = intval($_GET['id_alumni']);
                        $query = mysqli_query($koneksi, "DELETE FROM alumni WHERE id_alumni='$id_alumni'");
                        if ($query) {
                            $_SESSION['alert'] = [
                                'icon' => 'success',
                                'title' => 'Berhasil!',
                                'text' => 'Alumni berhasil dihapus!'
                            ];
                            header("Location: dashboard.php?url=kelola_alumni.php");
                            exit;
                        } else {
                            $_SESSION['alert'] = [
                                'icon' => 'error',
                                'title' => 'Gagal!',
                                'text' => 'Gagal menghapus alumni!'
                            ];
                            header("Location: dashboard.php?url=kelola_alumni.php");
                            exit;
                        }
                    }
                case 'kelola_ujian.php':
                    include 'kelola_ujian.php';
                    break;
                case 'edit_ujian':
                    include 'edit_ujian.php';
                    break;
                case 'detail_ujian':
                    include 'detail_ujian.php';
                    break;
                case 'detail_peserta':
                    include 'detail_peserta.php';
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
                            header("Location: dashboard.php?url=kelola_ujian.php");
                            exit;
                        } else {
                            $_SESSION['alert'] = [
                                'icon' => 'error',
                                'title' => 'Gagal!',
                                'text' => 'Gagal menghapus Ujian!'
                            ];
                            header("Location: dashboard.php?url=kelola_ujian.php");
                            exit;
                        }
                    }
                    break;
                case 'kelola_ajuan_sertifikat.php':
                    include 'kelola_ajuan_sertifikat.php';
                    break;
                // === DEFAULT ===
                default:
                    echo "Maaf halaman tidak ditemukan!";
                    break;
            }
        } else {
        ?>

            <div class="pagetitle">
                <h1>Dashboard Petugas</h1>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    <?php
                    $sql = "
                    SELECT COUNT(*) as total_pen 
                    FROM pendaftar";
                    $pen_q = mysqli_query($koneksi, $sql);
                    $total_pen = mysqli_fetch_assoc($pen_q)
                    ?>
                    <!-- Card Pendaftar -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Pendaftar <span id="pendaftar-label"></span></h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="tanggal" data-filter="hari">Hari Ini</a></li>
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="tanggal" data-filter="bulan">Bulan Ini</a></li>
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="tanggal" data-filter="tahun">Tahun Ini</a></li>
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="tanggal" data-filter="semua">Semua</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="pendaftar-count"><?= $total_pen['total_pen']; ?></h6>
                                        <span class="text-muted small pt-2 ps-1" id="pendaftar-label"></span>
                                    </div>
                                </div>
                            </div><!-- End Card -->
                        </div>
                    </div>
                    <?php
                    $sql = "
                    SELECT COUNT(*) as total_pes 
                    FROM peserta";
                    $pes_q = mysqli_query($koneksi, $sql);
                    $total_pes = mysqli_fetch_assoc($pes_q)
                    ?>
                    <!-- Card Peserta -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Peserta <span id="peserta-label"></span>
                                    <!-- Tombol titik 3 dropdown -->
                                    <div class="dropdown float-end">
                                        <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="program-peserta" data-filter="all">Semua Program</a></li>
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="program-peserta" data-filter="privat">Privat Permateri</a></li>
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="program-peserta" data-filter="reguler_materi">Reguler Permateri</a></li>
                                            <li><a class="dropdown-item filter-btn" href="#" data-type="program-peserta" data-filter="reguler_paket">Reguler Paket</a></li>

                                        </ul>
                                    </div>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="peserta-count"><?= $total_pes['total_pes']; ?></h6>
                                    </div>
                                </div>
                            </div><!-- End Card -->
                        </div>
                    </div>
                    <?php
                    $sql = "
                    SELECT COUNT(*) as total_al 
                    FROM alumni";
                    $al_q = mysqli_query($koneksi, $sql);
                    $total_al = mysqli_fetch_assoc($al_q)
                    ?>
            </section>
        <?php }
        ob_end_flush(); ?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Script Filter -->
    <script>
        let filterTanggal = "hari";
        let filterProgram = "all";
        let filterProgram1 = "all";

        $(document).on("click", ".filter-btn", function() {
            let type = $(this).data("type");
            let filter = $(this).data("filter");

            // kalau filter tanggal → hanya untuk pendaftar
            if (type === "tanggal") {
                filterTanggal = filter;
            }
            // kalau filter program peserta
            else if (type === "program-peserta") {
                filterProgram = filter;
            }
            // kalau filter program alumni
            else if (type === "program-alumni") {
                filterProgram1 = filter;
            }

            loadData();
        });

        function loadData() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    filter_date: filterTanggal,
                    filter_program: filterProgram,
                    filter_program1: filterProgram1
                },
                dataType: "json",
                success: function(res) {
                    $("#pendaftar-count").text(res.pendaftar);
                    $("#peserta-count").text(res.peserta);
                    $("#alumni-count").text(res.alumni);

                    $("#pendaftar-label").text("| " + res.labelTanggal);
                    $("#peserta-label").text("| " + res.labelProgram);
                    $("#alumni-label").text("| " + res.labelProgram1);
                }
            });
        }

        // pertama kali load
        loadData();
    </script>

</body>

</html>