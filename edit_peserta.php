<?php
include 'koneksi.php';
$id_peserta = $_GET['id_peserta'];

// Ambil data peserta
$query = mysqli_query($koneksi, "SELECT * FROM peserta WHERE id_peserta = '$id_peserta'");
$data = mysqli_fetch_assoc($query);

// simpan id_jurusan lama untuk diset otomatis nanti
$selectedId = $data['id_jurusan'];
?>
<div class="pagetitle">
    <h1>Kelola Peserta</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_peserta.php">Kelola Peserta Kursus</a></li>
            <li class="breadcrumb-item active">Edit Peserta</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Peserta</h5>

        <form method="post" action="simpan_peserta.php">
            <!-- Nama -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_lengkap" 
                        value="<?= htmlspecialchars($data['nama_lengkap']) ?>">
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jk" value="Laki-laki"
                            <?= ($data['jk'] == 'Laki-laki') ? 'checked' : '' ?>>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jk" value="Perempuan"
                            <?= ($data['jk'] == 'Perempuan') ? 'checked' : '' ?>>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </fieldset>

            <!-- Tanggal Lahir -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_lahir" 
                        value="<?= $data['tanggal_lahir'] ?>">
                </div>
            </div>

            <!-- No HP -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No. Telp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" 
                        value="<?= $data['no_hp'] ?>">
                </div>
            </div>

            <!-- Program -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-10">
                    <select class="form-control" name="program" id="program" onchange="loadJurusan()" required>
                        <option value="" disabled>-- Pilih Program --</option>
                        <option value="privat" <?= ($data['program'] == 'privat') ? 'selected' : '' ?>>Privat Mandiri</option>
                        <option value="reguler_materi" <?= ($data['program'] == 'reguler_materi') ? 'selected' : '' ?>>Reguler (Permateri)</option>
                        <option value="reguler_paket" <?= ($data['program'] == 'reguler_paket') ? 'selected' : '' ?>>Reguler (Paket)</option>
                    </select>
                </div>
            </div>

            <!-- Jurusan Dinamis -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Paket / Materi</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_jurusan" id="jurusan" required>
                        <option value="">-- Pilih Jurusan --</option>
                    </select>
                </div>
            </div>

            <script>
                function loadJurusan() {
                    const program = document.getElementById("program").value;
                    const jurusanSelect = document.getElementById("jurusan");
                    const selectedId = "<?= $selectedId ?>";

                    jurusanSelect.innerHTML = '<option value="">Loading...</option>';

                    fetch("get_jurusan.php?program=" + program)
                        .then(response => response.json())
                        .then(data => {
                            jurusanSelect.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
                            data.forEach(j => {
                                let opt = document.createElement("option");
                                opt.value = j.id;
                                opt.textContent = j.nama;
                                if (String(j.id) === String(selectedId)) {
                                    opt.selected = true;
                                }
                                jurusanSelect.appendChild(opt);
                            });
                        })
                        .catch(err => {
                            jurusanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                            console.error(err);
                        });
                }

                document.addEventListener("DOMContentLoaded", function() {
                    if (document.getElementById("program").value !== "") {
                        loadJurusan();
                    }
                });
            </script>

            <!-- Tanggal Daftar -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_daftar" 
                        value="<?= $data['tanggal_daftar'] ?>">
                </div>
            </div>

            <!-- Tombol -->
            <div class="text-center">
                <input type="hidden" name="id_peserta" value="<?= $data['id_peserta'] ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form>
    </div>
</div>
