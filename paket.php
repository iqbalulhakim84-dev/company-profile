<?php
include 'layout/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tentang - Sejarah LPKII</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    .card {
      transition: all 0.3s ease;
      border: none;
      overflow: hidden;
      border-radius: 0.5rem;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Wrapper gambar + gradasi */
    .card-img-container {
      position: relative;
      overflow: hidden;
      border-radius: 0.5rem 0.5rem 0 0;
    }

    .card-img-container img {
      width: 100%;
      display: block;
      border-radius: 0.5rem 0.5rem 0 0;
      transition: filter 0.3s ease;
    }

    .card:hover .card-img-container img {
      filter: brightness(85%);
    }

    .card-img-container::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 60px;
      /* tinggi gradasi */
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, #fff 100%);
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
</head>

<body class="about-page">

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Paket Program<br></h1>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index">Beranda</a></li>
            <li><a href="program">Program Kursus LPKII</a></li>
            <li class="current">Paket Kursus Reguler<br></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <section id="trainers" class="section trainers">
      <div class="container">
        <div class="row gy-4">

          <!-- Card 1 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <a href="program_aplikasi" class="text-decoration-none text-dark">
              <div class="card h-100 text-center shadow-sm">
                <div class="card-img-container">
                  <img src="assets/img/pa600.png" alt="Program Aplikasi">
                </div>
                <div class="card-body">
                  <h4 class="card-title fw-bold mb-3">Program Aplikasi</h4>
                  <p class="card-text text-muted">
                    Merupakan Program Komputer yang langsung dapat dipergunakan untuk membantu kerja user dalam pembuatan surat, tabel, grafik, presentasi, laporan, rancangan sederhana, organisasi, pengolahan angka, dan lainnya.
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card 2 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <a href="program_desain" class="text-decoration-none text-dark">
              <div class="card h-100 text-center shadow-sm">
                <div class="card-img-container">
                  <img src="assets/img/pd600.png" alt="Program Desain">
                </div>
                <div class="card-body">
                  <h4 class="card-title fw-bold mb-3">Program Desain</h4>
                  <p class="card-text text-muted">
                    Program komputer untuk membuat desain grafis, manipulasi foto, logo, rancang bangun konstruksi, desain teknik, animasi, sablon, distro, dan banyak lagi.
                  </p>
                </div>
              </div>
            </a>
          </div>

          <!-- Card 3 -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <a href="pemrograman" class="text-decoration-none text-dark">
              <div class="card h-100 text-center shadow-sm">
                <div class="card-img-container">
                  <img src="assets/img/p600.png" alt="Pemrograman">
                </div>
                <div class="card-body">
                  <h4 class="card-title fw-bold mb-3">Pemrograman</h4>
                  <p class="card-text text-muted">
                    Program komputer untuk membuat aplikasi sesuai kebutuhan user, seperti sistem pengolahan database karyawan, payroll, stok barang, akademik, hingga berbagai aplikasi bisnis.
                  </p>
                </div>
              </div>
            </a>
          </div>

        </div>
      </div>
    </section>

  </main>

  <?php include 'layout/footer.php'; ?>

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