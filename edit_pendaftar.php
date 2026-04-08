<?php
include 'koneksi.php';

// amankan id_pendaftar
$id_pendaftar = intval($_GET['id_pendaftar'] ?? 0);
$query = mysqli_query($koneksi, "SELECT * FROM pendaftar WHERE id_pendaftar = '$id_pendaftar'");
$data = mysqli_fetch_assoc($query);

// tentukan id jurusan sesuai program
$selectedId = $data['id_jurusan'];
?>


<div class="pagetitle">
    <h1>Kelola Pendaftar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_pendaftar.php">Kelola Pendaftar</a></li>
            <li class="breadcrumb-item active">Edit Pendaftar</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Pendaftar</h5>

        <div class="overflow-x-scroll">
        <!-- Horizontal Form -->
        <form method="post" action="simpan_pendaftar.php">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nisn" value="<?= $data['nisn']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" value="<?= $data['nik']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tempat_lahir" value="<?= $data['tempat_lahir']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_lahir" value="<?= $data['tanggal_lahir']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat Sekarang</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat"><?= $data['alamat_sekarang']; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kode Pos Alamat Sekarang</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="kodePosSekarang" value="<?= $data['kode_pos']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No. Telp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" value="<?= $data['no_hp']; ?>">
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-10">
                    <div class="form-check radio-group">
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

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Agama</legend>
                <div class="col-sm-10">
                    <div class="form-check radio-group">
                        <input class="form-check-input" type="radio" name="agama" value="Islam"
                            <?= ($data['agama'] == 'Islam') ? 'checked' : '' ?>>
                        <label class="form-check-label">Islam</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="agama" value="Protestan"
                            <?= ($data['agama'] == 'Protestan') ? 'checked' : '' ?>>
                        <label class="form-check-label">Protestan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="agama" value="Katolik"
                            <?= ($data['agama'] == 'Katolik') ? 'checked' : '' ?>>
                        <label class="form-check-label">Katolik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="agama" value="Hindu"
                            <?= ($data['agama'] == 'Hindu') ? 'checked' : '' ?>>
                        <label class="form-check-label">Hindu</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="agama" value="Buddha"
                            <?= ($data['agama'] == 'Buddha') ? 'checked' : '' ?>>
                        <label class="form-check-label">Buddha</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="agama" value="Konghucu"
                            <?= ($data['agama'] == 'Konghucu') ? 'checked' : '' ?>>
                        <label class="form-check-label">Konghucu</label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pendidikan_terakhir" value="<?= $data['pendidikan_terakhir']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Lulusan Tahun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lulusan_tahun" value="<?= $data['lulusan_tahun']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_perusahaan" value="<?= $data['nama_perusahaan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat Perusahaan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamatPerusahaan"><?= $data['alamat_perusahaan']; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kode Pos Perusahaan</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="kodePosPerusahaan" value="<?= $data['kode_pos_perusahaan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Telp Perusahaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="noTelpPerusahaan" value="<?= $data['no_telp_perusahaan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Ibu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="namaIbu" value="<?= $data['nama_orangtua']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat Orangtua</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamatOrangTua"><?= $data['alamat_orangtua']; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kode Pos Orangtua</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="kodePosOrangTua" value="<?= $data['kode_pos_orangtua']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Telp Orangtua</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="noTelpOrangTua" value="<?= $data['no_telp_orangtua']; ?>">
                </div>
            </div>
            <!-- Kolom Program -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-10">
                    <select class="form-control" name="program" id="program" onchange="loadJurusan()" required>
                        <option value="">-- Pilih Program --</option>
                        <option value="privat" <?= ($data['program']=='privat')?'selected':'' ?>>Privat Mandiri</option>
                        <option value="reguler_materi" <?= ($data['program']=='reguler_materi')?'selected':'' ?>>Reguler (Permateri)</option>
                        <option value="reguler_paket" <?= ($data['program']=='reguler_paket')?'selected':'' ?>>Reguler (Paket)</option>
                    </select>
                </div>
            </div>

            <!-- Kolom Paket/Materi -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Paket / Materi</label>
                <div class="col-sm-10">
                    <select class="form-control" name="" id="jurusan" required>
                        <option value="">-- Pilih Jurusan --</option>
                    </select>
                </div>
            </div>

            <script>
            function loadJurusan(preselectedId = null) {
                const program = document.getElementById("program").value;
                const jurusanSelect = document.getElementById("jurusan");

                if (!program) {
                    jurusanSelect.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
                    return;
                }

                // ubah name sesuai program
                if (program === "privat") {
                    jurusanSelect.name = "id_daftar_materi_privat";
                } else if (program === "reguler_materi") {
                    jurusanSelect.name = "id_daftar_materi_reguler";
                } else {
                    jurusanSelect.name = "id_paket_kursus";
                }

                jurusanSelect.innerHTML = '<option value="">Loading...</option>';

                fetch("get_jurusan.php?program=" + program)
                .then(res => res.json())
                .then(data => {
                    jurusanSelect.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
                    data.forEach(j => {
                        let opt = document.createElement("option");
                        opt.value = j.id;
                        opt.textContent = j.nama;

                        // pilih default dari database
                        if (preselectedId && opt.value == preselectedId) {
                            opt.selected = true;
                        }

                        jurusanSelect.appendChild(opt);
                    });
                })
                .catch(err => {
                    console.error(err);
                    jurusanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
            }

            // jalankan saat halaman load
            window.addEventListener("DOMContentLoaded", () => {
                const program = "<?= $data['program']; ?>";
                const selectedId = "<?= $selectedId; ?>";

                if (program) {
                    // panggil setelah sedikit delay supaya fetch jalan
                    setTimeout(() => {
                        loadJurusan(selectedId);
                    }, 200);
                }
            });
            </script>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl" value="<?= $data['tgl']; ?>">
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="id_pendaftar" value="<?= $data['id_pendaftar']; ?>">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End Horizontal Form -->
        </div>

    </div>
</div>
