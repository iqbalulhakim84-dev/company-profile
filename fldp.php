<?php
session_start();
include "koneksi.php";
include "alert.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Lihat Data Peserta & Alumni</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logolpkii.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .pilih-peserta,
    .pilih-alumni {
      cursor: pointer;
    }

    .pilih-peserta:hover,
    .pilih-alumni:hover {
      background-color: #f1f1f1;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0px 0 30px #c75900;
    }

    .tab-nav-2019 {
      display: flex;
      justify-content: center;
      position: relative;
      margin-bottom: 20px;
    }

    .tab-item {
      padding: 10px 20px;
      cursor: pointer;
      text-decoration: none !important;
      color: inherit;
    }

    .tab-item.active {
      color: #FFD700;
      border-bottom: 3px solid #FFD700;
    }

    .tab-item:hover {
      text-decoration: none !important;
    }

    /* Agar card rapi di mobile */
    .card-wrapper {
      width: 100%;
      max-width: 440px;
    }
  </style>
</head>

<body style="background-color: #10B981;">

  <div class="container-fluid">
    <section class="section register d-flex flex-column align-items-center justify-content-center"
      style="min-height: 100vh; padding-top: 40px; padding-bottom: 40px;">
      <div class="row justify-content-center w-100">

        <!-- Header judul -->
        <div class="d-flex justify-content-center align-items-center">
          <img src="assets/img/logolpkii.png" alt="Logo" width="55" height="45" class="me-2">
        </div>
        <div class="d-flex justify-content-center align-items-center py-2 mb-3 text-center">
          <h3 class="m-0" style="color: #FFD700; font-size: 1.4rem;">Lihat Data Peserta & Alumni</h3>
        </div>

        <!-- Card -->
        <div class="card-wrapper">
          <div class="card mb-3">
            <div class="card-body">

              <!-- Tab Nav -->
              <div class="tab-nav-2019">
                <a class="tab-item active text-success" data-type="peserta">Peserta</a>
                <a class="tab-item text-success" data-type="alumni">Alumni</a>
              </div>

              <!-- Tab Content -->
              <div id="tab-content">
                <!-- Form Peserta -->
                <form id="form-peserta" class="row g-3" method="post" action="proses_ldp.php">
                  <div class="col-12">
                    <label for="namaPeserta" class="form-label">Nama Peserta</label>
                    <input type="text" id="namaPeserta" name="nama_peserta" class="form-control"
                      placeholder="Ketik nama peserta..." autocomplete="off">
                    <input type="hidden" id="idPeserta" name="id_peserta">
                    <input type="hidden" id="idAlumni" name="id_alumni">
                  </div>

                  <div class="col-12">
                    <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="tglLahir" name="tanggal_lahir" class="form-control">
                  </div>

                  <div class="col-12">
                    <label for="paketPeserta" class="form-label">Materi/Paket</label>
                    <input type="text" id="paketPeserta" name="nama_jurusan" class="form-control" readonly>
                    <input type="hidden" id="idJurusan" name="id_jurusan">
                    <input type="hidden" id="program" name="program">
                  </div>

                  <ul id="suggestionList" class="list-group"></ul>

                  <div class="text-center btn-group-custom">
                    <a href="index" class="btn btn-warning">Beranda</a>
                    <button class="btn btn-success" type="submit">Lihat Data Peserta</button>
                  </div>
                </form>

                <!-- Form Alumni -->
                <form id="form-alumni" class="row g-3 d-none" method="post" action="proses_ldp_alumni.php">
                  <div class="col-12">
                    <label for="namaAlumni" class="form-label">Nama Alumni</label>
                    <input type="text" id="namaAlumni" name="nama_peserta" class="form-control"
                      placeholder="Ketik nama alumni..." autocomplete="off">
                    <input type="hidden" id="idAlumni2" name="id_alumni">
                  </div>

                  <div class="col-12">
                    <label for="noInduk" class="form-label">Nomor Induk</label>
                    <input type="number" id="noInduk" name="no_induk" class="form-control"
                      placeholder="Masukkan nomor induk">
                  </div>

                  <div class="col-12">
                    <label for="paketAlumni" class="form-label">Materi/Paket</label>
                    <input type="text" id="paketAlumni" name="nama_jurusan" class="form-control" readonly>
                    <input type="hidden" id="idJurusanAlumni" name="id_jurusan">
                    <input type="hidden" id="programAlumni" name="program">
                  </div>

                  <ul id="suggestionListAlumni" class="list-group"></ul>

                  <div class="text-center btn-group-custom">
                    <a href="index" class="btn btn-warning">Beranda</a>
                    <button class="btn btn-success" type="submit">Lihat Data Alumni</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    $(document).ready(function() {
      // --- Tab switch ---
      $(".tab-item").click(function() {
        $(".tab-item").removeClass("active");
        $(this).addClass("active");

        if ($(this).data("type") === "peserta") {
          $("#form-peserta").removeClass("d-none");
          $("#form-alumni").addClass("d-none");
        } else {
          $("#form-peserta").addClass("d-none");
          $("#form-alumni").removeClass("d-none");
        }
      });

      // --- Autocomplete Peserta ---
      $("#namaPeserta").keyup(function() {
        let keyword = $(this).val();
        if (keyword.length >= 2) {
          $.post("get_peserta.php", {
            keyword: keyword
          }, function(data) {
            $("#suggestionList").html(data).show();
          });
        } else {
          $("#suggestionList").hide();
        }
      });

      // --- Autocomplete Alumni ---
      $("#namaAlumni").keyup(function() {
        let keyword = $(this).val();
        if (keyword.length >= 2) {
          $.post("get_alumni.php", {
            keyword: keyword
          }, function(data) {
            $("#suggestionListAlumni").html(data).show();
          });
        } else {
          $("#suggestionListAlumni").hide();
        }
      });

      // --- Pilih hasil Peserta ---
      $(document).on("click", ".pilih-peserta", function() {
        $("#namaPeserta").val($(this).data("nama"));
        $("#idPeserta").val($(this).data("id"));
        $("#idAlumni").val($(this).data("idalumni"));
        $("#paketPeserta").val($(this).data("jurusan"));
        $("#idJurusan").val($(this).data("idjurusan"));
        $("#program").val($(this).data("program"));
        $("#suggestionList").hide();
      });

      // --- Pilih hasil Alumni ---
      $(document).on("click", ".pilih-alumni", function() {
        $("#namaAlumni").val($(this).data("nama"));
        $("#idAlumni2").val($(this).data("idalumni"));
        $("#paketAlumni").val($(this).data("jurusan"));
        $("#idJurusanAlumni").val($(this).data("idjurusan"));
        $("#programAlumni").val($(this).data("program"));
        $("#suggestionListAlumni").hide();
      });
    });
  </script>
</body>

</html>