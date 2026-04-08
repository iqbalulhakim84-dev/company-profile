<?php
include_once "alert.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LKP LPKII</title>
  <!-- <link rel="icon" href="image/Logo OSIS 1.png" type="image/png"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <!-- Favicons -->
  <link href="assets/img/logolpkii.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <header id="header" class="header sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <!-- Logo -->
      <a href="index" class="logo d-flex align-items-center justify-content-center">
        <img src="assets/img/logolpkii.png" alt="">
        <h1 class="sitename">LKP LPKII</h1>
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index">Beranda</a></li>
          <li><a href="about"><span>Tentang Kami</span></a></li>
          <li class="dropdown"><a href="program"><span>Program LKP LPKII</span><i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="privat">Privat Mandiri (Permateri)</a></li>
              <li><a href="kursus_reguler">Kursus Reguler (Permateri)</a></li>
              <li class="dropdown"><a href="paket"><span>Kursus Reguler (Perpaket)</span><i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="program_aplikasi">Program Aplikasi</a></li>
                  <li><a href="program_desain">Program Desain</a></li>
                  <li><a href="pemrograman">Pemrograman</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="promo">Promo</a></li>
          <li><a href="galeri">Galeri</a></li>
          <li><a href="testimoni">Testimoni</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- Tombol -->
      <div class="ms-lg-3 mt-2 mt-lg-0">
        <a href="pendaftaran" class="btn btn-m" style="background-color: #5fcf80; color: #fff;">Daftar</a>
      </div>

    </div>
  </header>
</head>