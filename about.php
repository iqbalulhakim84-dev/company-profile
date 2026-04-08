<?php
include __DIR__ . "/layout/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tentang LPKII</title>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main CSS File -->
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

    /* Saat tertutup */
    .accordion-custom .accordion-button.collapsed {
      background-color: #ffffff;
      color: #5fc580;
      box-shadow: none;
    }

    /* Saat terbuka */
    .accordion-custom .accordion-button:not(.collapsed) {
      background-color: #7fd69a;
      color: #ffffff;
      box-shadow: none;
    }

    /* Icon default Bootstrap (caret) */
    .accordion-custom .accordion-button::after {
      filter: invert(48%) sepia(79%) saturate(322%) hue-rotate(94deg) brightness(90%) contrast(90%);
      /* ini bikin warna chevron jadi hijau (#5fc580) */
    }

    /* Saat terbuka, ubah jadi putih */
    .accordion-custom .accordion-button:not(.collapsed)::after {
      filter: brightness(0) invert(1);
      /* jadi putih */
    }
  </style>
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

    <!-- Judul -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Tentang Kami<br></h1>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index">Beranda</a></li>
            <li class="current">Tentang Kami<br></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Judul -->

    <!-- Bagian Tentang -->
    <section id="about-us" class="section about-us">

      <div class="container">
        <div class="row">

          <div class="col-lg-12 content" data-aos="fade-up">
            <h3>Tentang Kami</h3>
            <p><b>Lembaga Pendidikan Komputer Informatika Indonesia (LPKII)</b> adalah sebuah lembaga
              pendidikan yang fokus pada pengembangan keterampilan di bidang teknologi informasi
              dan komputer di Indonesia. LPKII bertujuan untuk memberikan pendidikan dan pelatihan
              berkualitas bagi individu yang ingin menguasai teknologi komputer dan informatika, dengan
              harapan dapat meningkatkan kompetensi mereka di dunia kerja atau dalam membangun usaha di
              sektor teknologi.
            </p>
            <br>
            <p>
              Tujuan utama dari LPKII adalah untuk mencetak tenaga profesional yang memiliki
              keterampilan dan pengetahuan yang mendalam di bidang komputer dan teknologi informasi,
              serta membekali mereka dengan kemampuan yang siap pakai di industri. Dengan pelatihan
              yang berfokus pada pengembangan keterampilan praktis, LPKII berharap dapat memberikan
              kontribusi positif terhadap dunia kerja dan mengurangi kesenjangan keterampilan di bidang
              teknologi di Indonesia.
            </p>
            <br>
            <p>
              LPKII juga aktif menjalin kerja sama dengan berbagai perusahaan dan industri untuk
              menciptakan peluang kerja bagi lulusannya. Selain itu, LPKII memiliki komunitas alumni
              yang mendukung interaksi dan kolaborasi antar lulusan, serta menjadi wadah untuk berbagi informasi,
              pengalaman, dan peluang karir.
            </p>
          </div>
        </div>
      </div>

    </section><!-- /Bagian Tentang -->

    <div class="container mb-5">
      <div class="accordion accordion-custom" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <strong>Sejarah LPKII</strong>
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" >
            <div class="accordion-body">
              <p>
                Berawal dari krisis ekonomi tahun 1997 <strong>Lembaga Pendidik Komputer Manajemen Indonesia - LPKMI</strong>
                yang berlokasi di Jl. Jendral Sudirman No. 641 Bandung tidak dapat melanjutkan proses kegiatan
                belajar mengajar program studi Komputer Akuntasi setara Diploma Satu Tahun dengan jumlah
                peserta didik yang tersisa sebanyak 20 orang dan ditambah dengan ada permasalahan internal
                kepengurusan yayasan yang cukup komplek sehingga diputuskan LPKMI tidak dapat melanjutkan
                proses kegiatan belajar hingga sampai berakhir program studi Komputer Akuntansi.
              </p>
              <p>
                Pada saat itu pihak Akademik LPKMI telah menawarkan proses kegiatan belajar mengajar
                dialihkan ke lembaga lain namun karena tidak ada kesepakatan biaya pendidikan maka proses
                kegiatan belajar mengajar untuk sementara dihentikan terlebih dahulu.
              </p>
              <p>
                Dengan kejadian itu pihak kami merasa prihatin, sehingga berjuang bagaimana supaya warga belajar tetap
                dapat menyelesaikan proses pembelajaran hingga sampai akhir, semenjak itu didirikanlah Lembaga
                LPKII, karena merasa simpati dan menawarkan kepada pihak LPKMI untuk mengalihkan proses
                kegiatan belajar mengajar dialihkan/dilanjutkan di <strong>Lembaga Pendidikan Komputer Informatika
                  Indonesia - LPKII</strong> yang berlokasi di Jl. Raya Cibabat No. 439 Cimahi tercatat sejak tanggal 01
                Maret 1998 dan sekaligus awal berdirinya LPKII di Kota Cimahi.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <Strong>Latar Belakang Berdirinya LPKII</Strong>
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" >
            <div class="accordion-body">
              <p>
                Penyelenggaraan Pelatihan dan Kursus merupakan wujud nyata partisipasi masyarakat dalam
                mewujudkan tujuan pendidikan nasional. Oleh sebab itu, Lembaga Pendidikan Komputer
                Informatika Indonesia (LPKII) didirikan sesuai dengan Undang-Undang Dasar 1945 yaitu
                telah diamanatkan bahwa "Salah Satu Tujuan Nasional adalah Mencerdaskan Kehidupan Bangsa"
                dan Undang-undang No. 2 Tahun 1989 tentang "Sistem Pendidikan bukan hanya menjadi tanggung
                jawab pemerintah semata, tetapi masyarakat sebagai mitra pemerintah berkesempatan yang
                seluas-luasnya untuk berperan serta dalam penyelenggaraan pendidikan".
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <strong>Visi & Misi LPKII</strong>
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" >
            <div class="accordion-body">
              <h5>Visi LPKII</h5>
              <ol>
                <li>Menjadikan Lembaga Pelatihan dan Kursus yang bertaraf Nasional</li>
                <li>Ikut serta Mencerdaskan Bangsa</li>
                <li>Menjadikan Warga Belajar mendapat Pengalaman,
                  Pengetahuan dan Keterampilan yang dibutuhkannya dan dapat diterapkan dalam lingkungan dunia kerja</li>
              </ol>
              <h5>Misi LPKII</h5>
              <ol>
                <li>Membuka cabang Lembaga Pendidikan dan Pelatihan diseluruh Indonesia</li>
                <li>Memberi bekal Keterampilan, Pengalaman dan Pengetahuan yang berorientasi pada perkembangan teknologi dan kebutuhan pasar</li>
                <li>Melayani warga belajar dengan kualitas layanan, materi dan latihan-latihan yang diterapkan dalam dunia kerja</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <strong>Motto LPKII</strong>
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" >
            <div class="accordion-body">
              <p>
                "Tingkatkan Kualitas Kemampuan Anda Seiring Kemajuan Teknologi dan Era Globalisasi Bersama
                Kami"
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              <strong>Tujuan LPKII</strong>
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" >
            <div class="accordion-body">
              <p>
                Untuk memperluas upaya pemerataan pendidikan dan pelatihan (kursus) guna memberi bekal kepada warga belajar yang ingin mengembangkan diri, memperluas wawasan, menambah pengetahuan, keterampilan, dan kemampuan untuk bekerja. Mengembangkan profesi atau untuk melanjutkan ke tingkat/jenjang pendidikan yang lebih tinggi.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
              <strong>Sasaran LPKII</strong>
            </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse" >
            <div class="accordion-body">
              <ol>
                <li>Membantu masyarakat dalam menghadapi ketatnya persaingan untuk mendapatkan kesempatan kerja
                  pada perusahaan</li>
                <li>Membantu pegawai/pekerja/karyawan untuk meningkatkan kesejahteraan sosial dilingkungan kerja</li>
                <li>Membantu warga belajar dalam rangka meningkatkan keterampilan, kemampuan dan keahlian</li>
                <li>Membantu pelajar/mahasiswa baik yang masih ataupun yang telah lulus dalam memenuhi standar
                  persyaratan nilai/kelulusan/melamar dan lain-lain</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
              <strong>Kelebihan LPKII</strong>
            </button>
          </h2>
          <div id="collapseSeven" class="accordion-collapse collapse" >
            <div class="accordion-body">
              <ol>
                <li>Sampai Tahun 2009 telah meluluskan kurang lebih 10.000,-siswa</li>
                <li>Sekitar 80% - 85% lulusan telah bekerja diberbagai Instalasi/Perusahaan Swasta, BUMN maupun Pemerintah</li>
                <li>Telah bekerjasama dengan tidak kurang dari 387 Perusahaan/Instalasi/Akademik Daerah maupun Nasional</li>
                <li>Mendapatkan Penghargaan Walikota Cimahi tentang LPK Komputer terbaik Tingkat Kota Cimahi Tahun 2007</li>
                <li>Mendapatkan Penghargaan ke-2 LPK Komputer terbaik Tingkat Koordinasi</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div><!-- Link ke dropdown -->

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