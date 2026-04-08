<?php
session_start();
include "koneksi.php";
include "alert.php";
$materi_q = mysqli_query($koneksi, "SELECT * FROM materi ORDER BY id_materi ASC");
$peserta_q = mysqli_query($koneksi, "SELECT * FROM peserta ORDER BY id_peserta ASC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FORM UJIAN</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
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

    <style>
        /* Agar form nyaman di mobile */
        .card {
            max-width: 100%;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0px 0 15px rgba(0, 0, 0, 0.15);
        }

        @media (min-width: 576px) {
            .card {
                width: 440px;
            }
        }

        .form-control {
            width: 100%;
        }

        .btn-group-custom {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>

<body>

    <main style="background-color: #10B981;">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center mb-3">
                                <img src="assets/img/logolpkii.png" alt="" width="70" height="55" class="me-2">
                                <!-- <h3 class="d-none d-lg-block" style="color: #FFD700;">FORM UJIAN SISWA</h3> -->
                            </div>

                            <div class="card mb-3">

                                <div class="card-body">
                                    <div class="pt-3 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4" style="color: #FFD700;">FORM UJIAN</h5>
                                    </div>

                                    <form method="post" action="tambah_ujian_peserta.php">
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <select class="form-control" id="id_peserta" name="id_peserta" required>
                                                <option value="" selected disabled>-- Pilih Peserta --</option>
                                                <?php while ($peserta = mysqli_fetch_assoc($peserta_q)) { ?>
                                                    <option value="<?= $peserta['id_peserta'] ?>">
                                                        <?= $peserta['nama_lengkap'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" id="tglLahir" name="tanggal_lahir" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Materi Ujian</label>
                                            <select class="form-control" id="id_materi" name="id_materi" required>
                                                <option value="" selected disabled>-- Pilih Materi --</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Ujian</label>
                                            <input type="date" class="form-control" name="tgl_ujian" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No PC</label>
                                            <select class="form-control" name="no_pc" required>
                                                <option value="" selected disabled>-- Pilih No PC --</option>
                                                <?php for ($i = 1; $i <= 14; $i++) { ?>
                                                    <option value="PC-<?= $i ?>">PC-<?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <select class="form-control" name="ket" required>
                                                <option value="" selected disabled>-- Pilih Keterangan Ujian--</option>
                                                <option value="Ujian Pertama">Ujian Pertama</option>
                                                <option value="Remedial">Remedial</option>
                                            </select>
                                        </div>

                                        <div class="text-center btn-group-custom">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">Kosongkan</button>
                                            <a href="index" class="btn btn-warning text-white align-items-center">Kembali Ke Beranda</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        document.getElementById('id_peserta').addEventListener('change', function() {
            let pesertaId = this.value;
            let materiSelect = document.getElementById('id_materi');
            materiSelect.innerHTML = '<option value="" selected disabled>-- Pilih Materi --</option>';

            fetch('get_materi.php?id_peserta=' + pesertaId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(m => {
                        let opt = document.createElement('option');
                        opt.value = m.id_materi;
                        opt.textContent = m.nama_materi;
                        materiSelect.appendChild(opt);
                    });
                });
        });
    </script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>