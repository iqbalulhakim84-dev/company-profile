<?php
include 'layout/header.php';
include 'koneksi.php';

$query = $koneksi->query("SELECT * FROM promo ORDER BY id_promo DESC LIMIT 1");
$promo = $query->fetch_assoc();
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
  <link href="assets/img/logo_lpkii.png" rel="icon">
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

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
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

  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <main class="main">

    <!-- Modal Promo LPKII -->
    <div class="modal fade" id="modalPromo" tabindex="-1" aria-labelledby="modalPromoLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
          <div class="modal-header" style="background-color: #5fc580;">
            <h5 class="modal-title" id="modalPromoLabel"><img src="assets/img/logolpkii.png" alt="Logo LPKII" width="50" height="35"> <?= $promo['nama_promo']; ?></h5>
            <button type="button" class="btn-close" style="color: #000;" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body text-center">
            <?php if (!empty($promo['gambar_promo'])): ?>
              <img src="assets/img/promo/<?= $promo['gambar_promo']; ?>" alt="Promo LPKII" class="img-fluid rounded mb-3">
            <?php endif; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Script agar modal otomatis muncul saat halaman dibuka
      window.addEventListener('load', function() {
        var myModal = new bootstrap.Modal(document.getElementById('modalPromo'));
        myModal.show();
      });
    </script>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background" style="height: 640px;">

      <img src="assets/img/lpkii2.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">Lembaga Kursus dan Pelatihan |<br>Lembaga Pendidikan Komputer <br>Informatika Indonesia</h2>
        <p data-aos="fade-up" data-aos-delay="200">Tingkatkan Kualitas Kemampuan Anda<br>Seiring Kemajuan Teknologi dan Era Globalisasi Bersama Kami</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="pendaftaran" class="btn-get-started">Daftar Sekarang</a>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Tentang Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/4.jpg" class="img-fluid" alt="" style="scale: 105%;">
          </div>

          <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Lembaga Kursus dan Pelatihan |<br>
              Lembaga Pendidikan Komputer Informatika Indonesia
            </h3>
            <p class="fst-italic">
              Lembaga Pelatihan dan Pendidikan ini didirikan dengan tujuan untuk memberikan pelatihan dan
              pendidikan nonformal di bidang teknologi informasi, khususnya keterampilan komputer yang
              saat ini menjadi kebutuhan dasar di berbagai sektor kehidupan. Kami berkomitmen untuk
              menyediakan pembelajaran yang berkualitas, praktis, dan relevan dengan perkembangan zaman,
              serta mampu menjawab tantangan dunia kerja yang semakin kompetitif.<br>
              Melalui program-program pelatihan yang kami selenggarakan, diharapkan para peserta
              didik dapat meningkatkan kompetensi, produktivitas, serta membuka peluang lebih luas
              di dunia usaha maupun dunia kerja.
            </p>
            <a href="about" class="read-more"><span>Lihat Selengkapnya...</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section><!-- /Tentang Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="section why-us">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

              <div class="col-xl-4">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center" style="background-color: #5fcf80;">
                  <h1 style="color: #fff;">Mengapa Harus Memilih LPKII??</h1>
                  <br>
                  <i class="bi bi-patch-check-fill" style="color: #fff;font-size:2.8rem;"></i>
                  <p style="color: #fff;">Telah ter-Akreditasi oleh BAN PNFI dan Kemdiknas dan LA-LPK dari Kemnakertran dengan nilai "A"</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-2">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-clipboard-data"></i>
                  <p>LPKII Lembaga yang mendapat Lisensi Ujian Internasional Komputer dari ICDL Asia Pasifik yang mewakili Bandung Priyangan</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-2" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-star"></i>
                  <p>LPKII sebagai Lembaga Pelatihan dan Kursus Terbaik Provinsi Jawa Barat Tahun 2010</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-2" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-mortarboard"></i>
                  <p>Ribuan Lulusan LPKII telah bekerja diberbagai perusahaan dalam dan luar Negeri</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-2" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-ui-checks"></i>
                  <p>Telah banyak kerjasama lebih dari 378 dengan Dunia Usaha dan Dunia Industri, Perusahaan, Sekolah, PT. Poltek, BUMN, Dinas-dinas, DPRD, dll</p>
                </div>
              </div><!-- End Icon Box -->

            </div>
          </div>

        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Staff -->
    <section id="trainers-index" class="section trainers-index">

      <div class="container">

        <div class="row">
          <div class="row d-flex justify-content-center text-center mb-3" data-aos="fade-up" data-aos-delay="200">
            <h3><b>Staff LPKII</b></h3>
          </div>
          <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="assets/img/team/pak_resa.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Resa Zulfikar Adiyasa</h4>
                <span>Instruktur</span>
              </div>
            </div>
          </div><!-- Anggota Staff -->

          <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <img src="assets/img/team/pak_arif22.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Arief Fathurahman</h4>
                <span>Administrasi & Instruktur</span>
              </div>
            </div>
          </div><!-- Anggota Staff -->

          <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <img src="assets/img/team/pak_deni.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Deni Koswara Kondita</h4>
                <span>Instruktur</span>
              </div>
            </div>
          </div><!-- Anggota Staff -->

          <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <img src="assets/img/team/pak_abdul.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Abdul Farid</h4>
                <span>Marketing & Bagian Umum</span>
              </div>
            </div>
          </div><!-- Anggota Staff -->

        </div>

      </div>

    </section><!-- /Staff -->

    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
      <iframe style="border:0; width: 100%; height: 300px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d277.88922237465835!2d107.54371923737688!3d-6.874018673954462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e4506d0f5261%3A0x357415e7bcfcc076!2sLembaga%20Pendidikan%20Komputer%20Informatika%20Indonesia%20(LPKII)!5e0!3m2!1sid!2sid!4v1751611309654!5m2!1sid!2sid" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- Google Maps -->

  </main>

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