<?php
include 'layout/header.php';
include 'koneksi.php';
$mat_reg = mysqli_query($koneksi, "SELECT * FROM daftar_materi_reguler");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LKP LPKII</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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

  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 6px 12px;
      text-align: left;
    }

    th {
      background-color: #eee;
    }

    tr:nth-child(even) {
      background-color: rgb(208, 206, 206);
    }

    /* Container pojok kanan bawah */
    .floating-container {
      position: fixed;
      bottom: 72px;
      right: 15px;
      /* geser biar gak tabrakan dengan scroll-top */
      z-index: 998;
      /* sedikit di bawah scroll-top (999) */
    }

    /* Tombol utama */
    .floating-btn {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      border: none;
      background-color: #5fcf80;
      /* hijau WA */
      color: #fff;
      font-size: 26px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
      transition: transform 0.3s, background 0.3s;
    }

    .floating-btn:hover {
      background-color: #3ac864ff;
      transform: scale(1.05);
    }

    /* Menu tepat di atas tombol utama */
    .floating-menu {
      position: absolute;
      bottom: 48px;
      right: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      /* selalu center ke tombol utama */
    }

    /* Tombol menu */
    .floating-menu a {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: #5fcf80;
      /* hijau sama */
      color: #fff;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s, opacity 0.3s, background 0.3s;
      margin-bottom: 10px;
      opacity: 0;
      pointer-events: none;
      transform: translateY(20px) scale(0.7);
      line-height: 1;
      position: relative;
    }

    /* Saat menu aktif */
    .floating-menu.show a {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0) scale(1);
    }

    /* Hover: ubah style */
    .floating-menu a:hover {
      background: #fff;
      color: #25d366;
      border-radius: 12px;
      /* biar agak kotak dengan sudut bulat */
    }

    /* Tooltip custom */
    .floating-menu a::after {
      content: attr(title);
      position: absolute;
      right: 60px;
      /* jarak dari tombol */
      background: #fff;
      color: #25d366;
      padding: 4px 8px;
      border-radius: 6px;
      white-space: nowrap;
      font-size: 14px;
      opacity: 0;
      transform: translateY(-50%);
      top: 50%;
      pointer-events: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      transition: opacity 0.2s ease;
    }

    /* Saat hover tooltip muncul */
    .floating-menu a:hover::after {
      opacity: 1;
    }

    .floating-menu.show a:nth-child(1) {
      transition-delay: 0.25s;
    }

    .floating-menu.show a:nth-child(2) {
      transition-delay: 0.15s;
    }

    .floating-menu.show a:nth-child(3) {
      transition-delay: 0.05s;
    }
  </style>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="about-page">

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Kursus Reguler Permateri<br></h1>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index">Beranda</a></li>
            <li><a href="program">Program Kursus LPKII</a></li>
            <li class="current">Kursus Reguler Permateri<br></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <div class="container mt-3 mb-5">
      <div class="col-lg-12 text-center">
        <h3>Daftar Biaya Kursus Reguler LPKII (PERMATERI)</h3>
      </div>
      <table border=1>
        <thead>
          <tr>
            <th>No</th>
            <th>Materi</th>
            <th>JP</th>
            <th>Biaya Paket</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 0;
          while ($data = mysqli_fetch_assoc($mat_reg)) {
            $no++;
          ?>
            <tr>
              <td><?= $no; ?></td>
              <td><?= $data['nama_materi']; ?></td>
              <td><?= $data['durasi']; ?></td>
              <td><?= '' . number_format($data['harga'], 0, ',', '.'); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <br>
      <div class="container mt-3">
        <div class="row">
          <div class="col-lg-6">
            <h4 class="text-center" style="color:#fff; background-color:#000;">PERSYARATAN</h4>
            <ol style="background-color:#ffffff;">
              <b>
                <li>Fotocopy Ijazah Terakhir</li>
                <li>Fotocopy KTP/SIM/KTM/KK</li>
                <li>Pas Photo 2x3, 3x4, @ 2 Lembar</li>
                <li>Mengisi Formulir Pendaftaran (Berwarna & Formal)</li>
                <li>Biaya Pendaftaran Rp. 100.000</li>
              </b>
            </ol>
          </div>
          <div class="col-lg-6 ">
            <h4 class="text-center" style="color:#fff; background-color:#000;">FASILITAS</h4>
            <ol>
              <b>
                <li>Gratis Modul Pegangan</li>
                <li>Gratis Ujian/Evaluasi</li>
                <li>Gratis Sertifikat + Legalisir</li>
              </b>
            </ol>
          </div>
        </div>
      </div>
    </div>
    </div>

    <?php
    include 'layout/footer.php';
    ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Floating Button with Circular Dropdown -->
    <div class="floating-container">
      <button class="floating-btn" style="background-color: #5fcf80;">
        <i class="bi bi-three-dots"></i>
      </button>
      <div class="floating-menu">
        <a href="form_ujian" title="Ujian"><i class="bi bi-file-earmark-text"></i></a>
        <a href="fldp" title="Cek Data Peserta"><i class="bi bi-search"></i></a>
        <a href="https://wa.me/6282123246899" target="_blank" title="Whatsapp"><i class="bi bi-whatsapp"></i></a>
      </div>
    </div>

    <script>
      document.querySelector('.floating-btn').addEventListener('click', function() {
        document.querySelector('.floating-menu').classList.toggle('show');
      });
    </script>
    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>