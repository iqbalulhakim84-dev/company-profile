<?php
include 'koneksi.php';
include "functions.php";

$pes_q = mysqli_query($koneksi, "
  SELECT 
    p.id_peserta,
    p.jk,
    p.tanggal_lahir,
    p.no_hp,
    p.program,
    p.id_jurusan,
    p.tanggal_daftar,
    COALESCE(pn.nama_lengkap, p.nama_lengkap) AS nama_lengkap,
    -- Ambil nama jurusan dari join tabel sesuai program
    COALESCE(mp.nama_materi, mr.nama_materi, pk.nama_paket) AS nama_jurusan
  FROM peserta p
  LEFT JOIN pendaftar pn ON p.id_pendaftar = pn.id_pendaftar
  LEFT JOIN daftar_materi_privat mp ON (p.program = 'privat' AND p.id_jurusan = mp.id_daftar_materi_privat)
  LEFT JOIN daftar_materi_reguler mr ON (p.program = 'reguler_materi' AND p.id_jurusan = mr.id_daftar_materi_reguler)
  LEFT JOIN paket_kursus pk ON (p.program = 'reguler_paket' AND p.id_jurusan = pk.id_paket_kursus)
  ORDER BY nama_lengkap ASC
");

if (!$pes_q) {
  die("Query error: " . mysqli_error($koneksi));
}
?>

<div class="pagetitle">
  <h1>Kelola Peserta Kursus</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
      <li class="breadcrumb-item active">Kelola Peserta Kursus</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card">
  <div class="card-body overflow-x-scroll overflow-y-scroll">
    <h5 class="card-title position-absolute">Data Peserta Kursus</h5><br><br>

    <!-- Tabel Data Peserta Kursus -->
    <table class="table datatable" style="width: max-content;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>JK</th>
          <th>Tanggal Lahir</th>
          <th>No Telp</th>
          <th>Program</th>
          <th>Paket/Materi</th>
          <th>Tanggal Daftar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        while ($data = mysqli_fetch_assoc($pes_q)) {
          $no++;
          ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= htmlspecialchars($data['nama_lengkap']); ?></td>
            <td><?= htmlspecialchars($data['jk']); ?></td>
            <td><?= htmlspecialchars($data['tanggal_lahir']); ?></td>
            <td><?= htmlspecialchars($data['no_hp']); ?></td>
            <td><?= htmlspecialchars($data['program']); ?></td>
            <td><?= htmlspecialchars($data['nama_jurusan']); ?></td>
            <td><?= htmlspecialchars($data['tanggal_daftar']); ?></td>
            <td>
              <a href="?url=edit_peserta&id_peserta=<?= $data['id_peserta']; ?>" class="btn btn-success">
                <i class="bi bi-pencil-square"></i>
              </a> |
              <a href="?url=hapus_peserta&id_peserta=<?= $data['id_peserta']; ?>" 
                 class="btn btn-danger" 
                 onclick="confirmDelete(this)">
                 <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- End Tabel Data Peserta Kursus -->

  </div>
</div>

<?php
include 'koneksi.php';

// Ambil data paket/materi dari database
$paket_q   = mysqli_query($koneksi, "SELECT * FROM paket_kursus ORDER BY nama_paket ASC");
$privat_q  = mysqli_query($koneksi, "SELECT * FROM daftar_materi_privat ORDER BY nama_materi ASC");
$reguler_q = mysqli_query($koneksi, "SELECT * FROM daftar_materi_reguler ORDER BY nama_materi ASC");

// Simpan ke array supaya bisa di-encode ke JS
$paket_data   = [];
$privat_data  = [];
$reguler_data = [];

while ($paket = mysqli_fetch_assoc($paket_q)) {
  $paket_data[] = $paket;
}
while ($p = mysqli_fetch_assoc($privat_q)) {
  $privat_data[] = $p;
}
while ($r = mysqli_fetch_assoc($reguler_q)) {
  $reguler_data[] = $r;
}
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Tambah Peserta</h5>

    <!-- Form Tambah Peserta -->
    <form method="post" action="tambah_peserta.php">
      <!-- Nama -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nama_lengkap" required>
        </div>
      </div>

      <!-- Jenis Kelamin -->
      <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jk" value="laki-laki" required>
            <label class="form-check-label">Laki-laki</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jk" value="perempuan" required>
            <label class="form-check-label">Perempuan</label>
          </div>
        </div>
      </fieldset>

      <!-- Tanggal Lahir -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" name="tanggal_lahir" required>
        </div>
      </div>

      <!-- Nomor HP -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">No. Telp</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="no_hp" required>
        </div>
      </div>

      <!-- Program -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Program</label>
        <div class="col-sm-10">
          <select class="form-select" id="program" name="program" required>
            <option value="" disabled selected>-- Pilih Program --</option>
            <option value="reguler_paket">Reguler Paket</option>
            <option value="privat">Privat</option>
            <option value="reguler_materi">Reguler Materi</option>
          </select>
        </div>
      </div>

      <!-- Pilihan Paket/Materi -->
      <div class="row mb-3" id="jurusan-container" style="display:none;">
        <label for="id_jurusan" class="col-sm-2 col-form-label">Paket/Materi</label>
        <div class="col-sm-10">
          <select class="form-select" id="id_jurusan" name="id_jurusan">
            <option value="" disabled selected>-- Pilih Program dulu --</option>
          </select>
        </div>
      </div>

      <!-- Tanggal Daftar -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" name="tanggal_daftar" required>
        </div>
      </div>

      <!-- Tombol -->
      <div class="text-center">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-secondary">Kosongkan</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const programSelect = document.getElementById("program");
  const jurusanContainer = document.getElementById("jurusan-container");
  const jurusanSelect = document.getElementById("id_jurusan");

  // Data dari PHP
  const dataPaket   = <?= json_encode($paket_data); ?>;
  const dataPrivat  = <?= json_encode($privat_data); ?>;
  const dataReguler = <?= json_encode($reguler_data); ?>;

  programSelect.addEventListener("change", function() {
    const program = this.value;
    jurusanSelect.innerHTML = ""; // reset opsi

    if (!program) {
      jurusanContainer.style.display = "none";
      return;
    }

    jurusanContainer.style.display = "flex";

    let options = `<option value="" disabled selected>-- Pilih Paket/Materi --</option>`;

    if (program === "reguler_paket") {
      dataPaket.forEach(item => {
        options += `<option value="${item.id_paket_kursus}">${item.nama_paket}</option>`;
      });
    } else if (program === "privat") {
      dataPrivat.forEach(item => {
        options += `<option value="${item.id_daftar_materi_privat}">${item.nama_materi}</option>`;
      });
    } else if (program === "reguler_materi") {
      dataReguler.forEach(item => {
        options += `<option value="${item.id_daftar_materi_reguler}">${item.nama_materi}</option>`;
      });
    }

    jurusanSelect.innerHTML = options;
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

  function confirmLuluskan(el) {
    event.preventDefault(); // cegah redirect langsung
    let href = el.getAttribute('href'); // ambil URL dari tombol

    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Meluluskan peserta ini?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: 'rgba(55, 177, 18, 1)',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Luluskan!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = href;
      }
    });
  }
</script>