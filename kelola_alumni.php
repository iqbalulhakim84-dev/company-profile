<?php
include 'koneksi.php';

// Ambil semua alumni
$al_q = mysqli_query($koneksi, "SELECT * FROM alumni ORDER BY tanggal_lulus DESC");

// Fungsi bantu untuk mendapatkan nama jurusan/materi/paket
function getNamaJurusan($koneksi, $program, $idJurusan)
{
    if (!$idJurusan) return null;
    if ($program === 'privat') {
        $q = $koneksi->prepare("SELECT nama_materi FROM daftar_materi_privat WHERE id_daftar_materi_privat = ?");
    } elseif ($program === 'reguler_materi') {
        $q = $koneksi->prepare("SELECT nama_materi FROM daftar_materi_reguler WHERE id_daftar_materi_reguler = ?");
    } elseif ($program === 'reguler_paket') {
        $q = $koneksi->prepare("SELECT nama_paket AS nama_materi FROM paket_kursus WHERE id_paket_kursus = ?");
    } else {
        return null;
    }
    $q->bind_param('s', $idJurusan);
    $q->execute();
    $res = $q->get_result()->fetch_assoc();
    return $res['nama_materi'] ?? '-';
}
?>

<div class="pagetitle">
    <h1>Kelola Alumni</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Alumni</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card mb-4">
    <h5 class="card-title position-absolute ms-4">Data Alumni</h5><br><br>
    <div class="card-body overflow-x-scroll">
        <!-- Tabel Data Alumni -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>No Induk</th>
                    <th>Tanggal Lahir</th>
                    <th>Program</th>
                    <th>Jurusan</th>
                    <th>No Sertifikat</th>
                    <th>No Ujian</th>
                    <th>Tanggal Lulus</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($al_q)) {
                    $no++;
                    $namaJurusan = getNamaJurusan($koneksi, $data['program'], $data['id_jurusan']);
                ?>
                    <tr>
                        <td><?= htmlspecialchars($no); ?></td>
                        <td><?= htmlspecialchars($data['nama_lengkap']); ?></td>
                        <td><?= htmlspecialchars($data['no_induk']); ?></td>
                        <td><?= htmlspecialchars($data['tanggal_lahir']); ?></td>
                        <td><?= htmlspecialchars($data['program'] ?: 'Tidak Diketahui'); ?></td>
                        <td><?= htmlspecialchars($namaJurusan ?: $data['nama_jurusan']) ?: 'Tidak Diketahui'; ?></td>
                        <td><?= htmlspecialchars($data['no_sertifikat']); ?></td>
                        <td><?= htmlspecialchars($data['no_ujian']); ?></td>
                        <td><?= htmlspecialchars($data['tanggal_lulus'] ?: '-'); ?></td>
                        <td>
                            <!-- Tombol Aksi -->
                            <a href="?url=edit_alumni&id_alumni=<?= $data['id_alumni']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
                            <a href="?url=hapus_alumni&id_alumni=<?= htmlspecialchars($data['id_alumni']); ?> " class="btn btn-danger" style="font-size: 0.8rem;" onclick="confirmDelete(this)"><i class="bi bi-trash" style="font-size: medium;"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Data Alumni -->

    </div>
</div>

<!-- Form Tambah Alumni -->
<div class="card">
    <h5 class="card-title position-absolute ms-3">Tambah Alumni</h5><br><br>
    <div class="card-body">
        <form action="tambah_alumni.php" method="POST">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Induk</label>
                <div class="col-sm-10">
                    <input type="number" inputmode="numeric" name="no_induk" class="form-control" pattern="[0-9]*" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
            </div>

            <!-- Program -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-10">
                    <select name="program" id="program_alumni" class="form-control">
                        <option value="" disabled selected>-- Pilih Program --</option>
                        <option value="privat">Privat</option>
                        <option value="reguler_materi">Reguler Materi</option>
                        <option value="reguler_paket">Reguler Paket</option>
                    </select>
                </div>
            </div>

            <!-- Jurusan / Materi / Paket -->
            <div class="row mb-3" id="jurusan-container-alumni" style="display:none;">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <select name="id_jurusan" id="id_jurusan_alumni" class="form-control">
                        <option value="" disabled selected>-- Pilih Paket/Materi --</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Jurusan</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_jurusan" class="form-control" placeholder="Masukkan jika tidak ada program dan/atau materi/paket yang sesuai...">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Sertifikat</label>
                <div class="col-sm-10">
                    <input type="number" name="no_sertifikat" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">No Ujian</label>
                <div class="col-sm-10">
                    <input type="number" name="no_ujian" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lulus</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_lulus" class="form-control" required>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const programSelect = document.getElementById("program_alumni");
        const jurusanContainer = document.getElementById("jurusan-container-alumni");
        const jurusanSelect = document.getElementById("id_jurusan_alumni");

        programSelect.addEventListener("change", function() {
            const program = this.value;

            jurusanSelect.innerHTML = `<option value="" disabled selected>-- Pilih Paket/Materi --</option>`;

            if (!program) {
                jurusanContainer.style.display = "none";
                return;
            }

            jurusanContainer.style.display = "flex";

            // Ambil data jurusan sesuai program via AJAX
            fetch(`get_jurusan.php?program=${program}`)
                .then(res => res.json())
                .then(data => {
                    let options = `<option value="" disabled selected>-- Pilih Paket/Materi --</option>`;
                    data.forEach(item => {
                        options += `<option value="${item.id}">${item.nama}</option>`;
                    });
                    jurusanSelect.innerHTML = options;
                })
                .catch(err => {
                    console.error("Gagal ambil data jurusan:", err);
                });
        });
    });
</script>
<script>
    function confirmDelete(el) {
        event.preventDefault(); // cegah redirect langsung
        let href = el.getAttribute('href'); // ambil URL dari tombol

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus permanen dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    }
</script>