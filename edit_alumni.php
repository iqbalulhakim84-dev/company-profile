<?php
include 'koneksi.php';
$id_alumni = $_GET['id_alumni'];

// Ambil data alumni
$query = mysqli_query($koneksi, "SELECT * FROM alumni WHERE id_alumni = '$id_alumni'");
$data = mysqli_fetch_assoc($query);
?>

<div class="pagetitle">
    <h1>Kelola Alumni</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_alumni.php">Kelola Alumni</a></li>
            <li class="breadcrumb-item active">Edit Alumni</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Alumni</h5>

        <form method="post" action="simpan_alumni.php">
            <!-- Nama Lengkap -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_lengkap"
                        value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
                </div>
            </div>

            <!-- Nomor Induk -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Induk</label>
                <div class="col-sm-10">
                    <input type="text" inputmode="numeric" class="form-control" pattern="[0-9]*" name="no_induk"
                        value="<?= $data['no_induk'] ?>" required>
                </div>
            </div>

            <!-- Tanggal Lahir -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_lahir"
                        value="<?= $data['tanggal_lahir'] ?>" required>
                </div>
            </div>

            <!-- Program -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-10">
                    <select class="form-select" id="programSelect" name="program">
                        <option value="" disabled>-- Pilih Program --</option>
                        <option value="privat" <?= ($data['program'] == 'privat') ? 'selected' : '' ?>>Privat</option>
                        <option value="reguler_materi" <?= ($data['program'] == 'reguler_materi') ? 'selected' : '' ?>>Reguler Materi</option>
                        <option value="reguler_paket" <?= ($data['program'] == 'reguler_paket') ? 'selected' : '' ?>>Reguler Paket</option>
                        <option value="" <?= empty($data['program']) ? 'selected' : '' ?>>Tidak Diketahui</option>
                    </select>
                </div>
            </div>

            <!-- Nama Jurusan / Materi / Paket -->
            <div class="row mb-3" id="jurusan-container-alumni" style="display:flex;">
                <label class="col-sm-2 col-form-label">Nama Jurusan</label>
                <div class="col-sm-10">
                    <select class="form-select" id="jurusanSelect" name="id_jurusan">
                        <option value="" <?= empty($data['id_jurusan']) ? 'selected' : '' ?>>Custom</option>
                        <option value="">-- Pilih Paket/Materi --</option>
                        <!-- Options akan diisi oleh JS/AJAX -->
                    </select>
                </div>
            </div>

            <!-- Nama Jurusan Custom -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jurusan Custom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_jurusan"
                        value="<?= $data['nama_jurusan'] ?>" placeholder="Masukkan jika tidak ada program dan/atau paket/materi yang sesuai...">
                </div>
            </div>

            <!-- Nomor Sertifikat -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Sertifikat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_sertifikat"
                        value="<?= $data['no_sertifikat'] ?>" required>
                </div>
            </div>

            <!-- Nomor Ujian -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Ujian</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_ujian"
                        value="<?= $data['no_ujian'] ?>" required>
                </div>
            </div>

            <!-- Tanggal Lulus -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lulus</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_lulus"
                        value="<?= $data['tanggal_lulus'] ?>">
                </div>
            </div>

            <!-- Tombol -->
            <div class="text-end">
                <input type="hidden" name="id_alumni" value="<?= $data['id_alumni'] ?>">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const programSelect = $('#programSelect');
        const jurusanSelect = $('#jurusanSelect');
        const currentJurusan = '<?= $data['id_jurusan'] ?>'; // id_jurusan lama

        function loadJurusan(program) {
            jurusanSelect.html('<option value=""<?= empty($data['id_jurusan']) ? 'selected' : '' ?>>Custom</option>');
            if (!program) return;
            $.getJSON('get_jurusan.php?program=' + program, function(data) {
                data.forEach(item => {
                    const selected = (item.id == currentJurusan) ? 'selected' : '';
                    jurusanSelect.append(`<option value="${item.id}" ${selected}>${item.nama}</option>`);
                });
            });
        }

        // Load jurusan saat halaman dibuka
        loadJurusan(programSelect.val());

        // Load jurusan saat program berubah
        programSelect.change(function() {
            loadJurusan($(this).val());
        });
    });
</script>