<?php
session_start();
include "koneksi.php"; // pastikan $koneksi adalah mysqli
include "alert.php";

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
    return '-';
  }
  $q->bind_param('s', $idJurusan);
  $q->execute();
  $res = $q->get_result()->fetch_assoc();
  return $res['nama_materi'] ?? null;
}

function getNamaProgramJurusan($koneksi, $program, $idJurusan)
{
  $namaJurusan = getNamaJurusan($koneksi, $program, $idJurusan);

  // Ubah nama program biar lebih rapi (reguler_materi => Reguler Materi)
  $namaProgram = ucwords(str_replace('_', ' ', $program));

  return $namaProgram . " | " . $namaJurusan;
}

$id_peserta = '';
$id_alumni = '';

// Cek peserta
if (!empty($_POST['id_peserta'])) {
  $id_peserta = trim($_POST['id_peserta']);
  header('Location: data_peserta.php?id_peserta=' . urlencode($id_peserta));
  exit;
} elseif (!empty($_GET['id_peserta'])) {
  $id_peserta = trim($_GET['id_peserta']);
}

// Cek alumni
elseif (!empty($_POST['id_alumni'])) {
  $id_alumni = trim($_POST['id_alumni']);
  header('Location: data_peserta.php?id_alumni=' . urlencode($id_alumni));
  exit;
} elseif (!empty($_GET['id_alumni'])) {
  $id_alumni = trim($_GET['id_alumni']);
}



// Ambil data peserta/alumni
$peserta = null;
if ($id_peserta !== '') {
  // Cek di peserta
  $stmt = $koneksi->prepare("
        SELECT pn.*, p.id_peserta, p.nama_lengkap, p.status_peserta, p.tanggal_lulus, 
               p.no_hp, p.program, p.id_jurusan, 'peserta' AS sumber
        FROM peserta p
        JOIN pendaftar pn ON p.id_pendaftar = pn.id_pendaftar
        WHERE p.id_peserta = ? LIMIT 1
    ");
  $stmt->bind_param('s', $id_peserta);
  $stmt->execute();
  $res = $stmt->get_result();
  $peserta = $res->fetch_assoc();
  $stmt->close();

  // Kalau tidak ketemu, cek di alumni
} elseif (($id_peserta === null || $id_peserta === '') && $id_alumni != null) {
  $stmt = $koneksi->prepare("
        SELECT a.id_alumni, a.id_peserta, a.nama_lengkap, 
               'Lulus' AS status_peserta, 
               a.tanggal_lulus, a.no_induk, a.no_sertifikat, 
               a.no_ujian, a.program, a.nama_jurusan, a.id_jurusan, 
               'alumni' AS sumber
        FROM alumni a
        WHERE a.id_alumni = ? 
        LIMIT 1
    ");
  $stmt->bind_param('i', $id_alumni); // pakai 'i' kalau kolom id_alumni bertipe INT
  $stmt->execute();
  $res = $stmt->get_result();
  $peserta = $res->fetch_assoc();
  $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cek Data & Progress Belajar</title>
  <link href="assets/img/logolpkii.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#efe;">
  <div class="container py-4">

    <!-- Kalau ada peserta, tampilkan semua bagian -->
    <?php if ($peserta): ?>

      <!-- Data Diri -->
      <?php if ($peserta['sumber'] === 'peserta'): ?>
        <!-- Judul; tampilkan nama hanya kalau $peserta ada -->
        <h2 class="text-center mb-4">Cek Data & Progress Belajar
          <?php if ($peserta): ?>
            | <b><?= htmlspecialchars($peserta['nama_lengkap']) ?></b>
          <?php endif; ?>
        </h2>
        <!-- Data Diri Peserta -->
        <div class="accordion mb-4 shadow-sm" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Data Diri <?= htmlspecialchars($peserta['nama_lengkap']); ?>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body table-responsive">
                <table class="table table-borderless">
                  <tr>
                  <tr>
                    <td><strong>NIK</strong></td>
                    <td>: <?= htmlspecialchars($peserta['nik'] ?? '-') ?></td>
                  </tr>
                  <tr>
                    <td><strong>NISN</strong></td>
                    <td>: <?= htmlspecialchars($peserta['nisn']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nama</strong></td>
                    <td>: <?= htmlspecialchars($peserta['nama_lengkap']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tempat Lahir</strong></td>
                    <td>: <?= htmlspecialchars($peserta['tempat_lahir']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tanggal Lahir</strong></td>
                    <td>: <?= htmlspecialchars($peserta['tanggal_lahir']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat</strong></td>
                    <td>: <?= htmlspecialchars($peserta['alamat_sekarang']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kode Pos</strong></td>
                    <td>: <?= htmlspecialchars($peserta['kode_pos']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>: <?= htmlspecialchars($peserta['jk']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Agama</strong></td>
                    <td>: <?= htmlspecialchars($peserta['agama']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Pendidikan Terakhir</strong></td>
                    <td>: <?= htmlspecialchars($peserta['pendidikan_terakhir']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Lulusan Tahun</strong></td>
                    <td>: <?= htmlspecialchars($peserta['lulusan_tahun']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>No HP</strong></td>
                    <td>: <?= htmlspecialchars($peserta['no_hp'] ?? '-') ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nama Perusahaan</strong></td>
                    <td>: <?= htmlspecialchars($peserta['nama_perusahaan']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat Perusahaan</strong></td>
                    <td>: <?= htmlspecialchars($peserta['alamat_perusahaan']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kode Pos Perusahaan</strong></td>
                    <td>: <?= htmlspecialchars($peserta['kode_pos_perusahaan']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>No Telp Perusahaan</strong></td>
                    <td>: <?= htmlspecialchars($peserta['no_telp_perusahaan']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Jabatan</strong></td>
                    <td>: <?= htmlspecialchars($peserta['jabatan']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nama Orang Tua</strong></td>
                    <td>: <?= htmlspecialchars($peserta['nama_orangtua']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat Orang Tua</strong></td>
                    <td>: <?= htmlspecialchars($peserta['alamat_orangtua']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kode Pos Orang Tua</strong></td>
                    <td>: <?= htmlspecialchars($peserta['kode_pos_orangtua']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nomor Telepon Orang Tua</strong></td>
                    <td>: <?= htmlspecialchars($peserta['no_telp_orangtua']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Status Peserta</strong></td>
                    <td>: <?= htmlspecialchars($peserta['status_peserta']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tanggal Daftar</strong></td>
                    <td>: <?= htmlspecialchars($peserta['tgl']) ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Program Yang Diikuti Peserta -->
        <div class="card mb-4 shadow-sm">
          <div class="card-header bg-success text-white">
            Program yang Diikuti <?= htmlspecialchars($peserta['nama_lengkap']); ?>
          </div>
          <div class="card-body">
            <?php
            // Ambil data program peserta, kalau tidak ada cek alumni
            $stmt_prog = $koneksi->prepare(
              "SELECT p.program, p.id_jurusan
             FROM peserta p
             WHERE p.id_peserta = ?
             UNION
             SELECT a.program, a.id_jurusan
             FROM alumni a
             WHERE a.id_peserta = ?"
            );
            $stmt_prog->bind_param('ss', $id_peserta, $id_peserta);
            $stmt_prog->execute();
            $res_prog = $stmt_prog->get_result();

            if ($res_prog && $res_prog->num_rows > 0) {
              $row = $res_prog->fetch_assoc();
              $program   = $peserta['program'] ?? '';
              $idJurusan = $peserta['id_jurusan'] ?? '';

              // Ambil nama materi/jurusan sesuai program
              if ($program === 'privat') {
                $q = $koneksi->prepare("SELECT nama_materi AS nama_jurusan FROM daftar_materi_privat WHERE id_daftar_materi_privat = ?");
                $q->bind_param('s', $idJurusan);
              } elseif ($program === 'reguler_materi') {
                $q = $koneksi->prepare("SELECT nama_materi AS nama_jurusan FROM daftar_materi_reguler WHERE id_daftar_materi_reguler = ?");
                $q->bind_param('s', $idJurusan);
              } elseif ($program === 'reguler_paket') {
                $q = $koneksi->prepare("SELECT nama_paket AS nama_jurusan FROM paket_kursus WHERE id_paket_kursus = ?");
                $q->bind_param('s', $idJurusan);
              }
              if (isset($q)) {
                $q->bind_param('s', $idJurusan);
                $q->execute();
                $resJur = $q->get_result()->fetch_assoc();
                $namaJurusan = $resJur['nama_jurusan'] ?? null;

                echo "<h4 class='text-primary ms-auto mb-2'>"
                  . htmlspecialchars(ucwords(str_replace('_', ' ', $program)))
                  . " | "
                  . htmlspecialchars($namaJurusan)
                  . "</h4>";
              }

              // Ambil semua ujian peserta (sekali saja)
              $stmt_ujian = $koneksi->prepare(
                "SELECT u.id_ujian, u.id_materi, nu.nilai
                 FROM ujian u
                 LEFT JOIN nilai_ujian nu ON nu.id_ujian = u.id_ujian
                 WHERE u.id_peserta = ?"
              );
              $stmt_ujian->bind_param('s', $id_peserta);
              $stmt_ujian->execute();
              $res_ujian = $stmt_ujian->get_result();

              $ujian_map = [];
              while ($uj = $res_ujian->fetch_assoc()) {
                $ujian_map[$uj['id_materi']] = $uj;
              }

              // --- REGULER PAKET ---
              if ($program === 'reguler_paket') {
                $stmt_materi = $koneksi->prepare(
                  "SELECT mp.id_materi AS id_materi_paket, m.nama_materi
                     FROM materi_paket mp
                     JOIN materi m ON mp.id_materi = m.id_materi
                     WHERE mp.id_paket_kursus = ?
                     ORDER BY m.nama_materi"
                );
                $stmt_materi->bind_param('s', $idJurusan);
                $stmt_materi->execute();
                $res_materi = $stmt_materi->get_result();

                echo "<table class='table table-bordered'>
                      <tr><th>Materi</th><th>Status</th></tr>";

                while ($m = $res_materi->fetch_assoc()) {
                  $status = "❌ Belum Ujian";

                  // ambil apakah materi ini punya ujian
                  $stmt_punya = $koneksi->prepare("SELECT punya_ujian FROM materi WHERE id_materi = ?");
                  $stmt_punya->bind_param("i", $m['id_materi_paket']);
                  $stmt_punya->execute();
                  $res_punya = $stmt_punya->get_result()->fetch_assoc();
                  $punyaUjian = $res_punya['punya_ujian'] ?? 1;
                  $stmt_punya->close();

                  if ($punyaUjian == 0) {
                    $status = "✅ Tidak Perlu Ujian";
                  } else {
                    // cek apakah peserta sudah ujian untuk materi ini
                    if (isset($ujian_map[$m['id_materi_paket']])) {
                      $uj = $ujian_map[$m['id_materi_paket']];
                      if ($uj['nilai'] !== null && $uj['nilai'] !== '') {
                        if (is_numeric($uj['nilai']) && floatval($uj['nilai']) >= 82) {
                          $status = "✅ Lulus (" . htmlspecialchars($uj['nilai']) . ")";
                        } elseif (is_numeric($uj['nilai']) && floatval($uj['nilai']) >= 70) {
                          $status = "Boleh Remedial (" . htmlspecialchars($uj['nilai']) . ")";
                        } else {
                          $status = "❌ Tidak Lulus (" . htmlspecialchars($uj['nilai']) . ")";
                        }
                      } else {
                        $status = "🕒 Sudah Ujian, Menunggu Penilaian";
                      }
                    }
                  }

                  echo "<tr>
                          <td>" . htmlspecialchars($m['nama_materi']) . "</td>
                          <td>$status</td>
                        </tr>";
                }


                echo "</table>";
              } else {
                // --- PRIVAT / REGULER MATERI ---
                $namaMateri = $resJur['nama_jurusan'];
                $materiId   = $idJurusan;

                $status = "❌ Belum Ujian";
                if (isset($ujian_map[$materiId])) {
                  $uj = $ujian_map[$materiId];
                  if ($uj['nilai'] !== null && $uj['nilai'] !== '') {
                    if (is_numeric($uj['nilai']) && floatval($uj['nilai']) >= 82) {
                      $status = "✅ Lulus (" . htmlspecialchars($uj['nilai']) . ")";
                    } elseif (is_numeric($uj['nilai']) && floatval($uj['nilai']) >= 70) {
                      $status = "Boleh Remedial (" . htmlspecialchars($uj['nilai']) . ")";
                    } else {
                      $status = "❌ Tidak Lulus (" . htmlspecialchars($uj['nilai']) . ")";
                    }
                  } else {
                    $status = "🕒 Sudah Ujian, Menunggu Penilaian";
                  }
                }

                echo "<table class='table table-bordered'>
                      <tr><th>Materi</th><th>Status</th></tr>
                      <tr><td>" . htmlspecialchars($namaMateri) . "</td><td>$status</td></tr>
                      </table>";
              }
            } else {
              echo "<p class='text-danger'>Peserta belum terdaftar di program manapun.</p>";
            }
            ?>
          </div>
        </div>

        <!-- Status Pengajuan Sertifikat -->
        <div class="card shadow-sm">
          <div class="card-header bg-warning text-dark">Status Pengajuan Sertifikat</div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Materi/Paket</th>
                  <th>Status</th>
                  <th>Tanggal Pengajuan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Ambil data pengajuan sertifikat
                $stmt_ajuan = $koneksi->prepare("
                SELECT a.status, a.tanggal_pengajuan, a.program, a.id_jurusan,
                      COALESCE(pk.nama_paket, mr.nama_materi, mp.nama_materi) AS nama_program
                FROM ajuan_sertifikat a
                LEFT JOIN paket_kursus pk ON (a.program = 'reguler_paket' AND a.id_jurusan = pk.id_paket_kursus)
                LEFT JOIN daftar_materi_reguler mr ON (a.program = 'reguler_materi' AND a.id_jurusan = mr.id_daftar_materi_reguler)
                LEFT JOIN daftar_materi_privat mp ON (a.program = 'privat' AND a.id_jurusan = mp.id_daftar_materi_privat)
                WHERE a.id_peserta = ?
                ORDER BY a.tanggal_pengajuan DESC
              ");
                $stmt_ajuan->bind_param('s', $id_peserta);
                $stmt_ajuan->execute();
                $res_ajuan = $stmt_ajuan->get_result();

                // Cek apakah semua materi pada paket peserta sudah dinilai
                $boleh_ajukan = false; // default = tidak boleh

                if (!empty($peserta['id_jurusan'])) {
                  if ($peserta['program'] === 'reguler_paket') {
                    // cek semua materi dalam paket + punya_ujian
                    $stmt_cek = $koneksi->prepare("
      SELECT m.id_materi, m.punya_ujian, u.id_ujian, nu.nilai
      FROM materi_paket mp
      JOIN materi m ON mp.id_materi = m.id_materi
      LEFT JOIN ujian u ON u.id_materi = m.id_materi AND u.id_peserta = ?
      LEFT JOIN nilai_ujian nu ON nu.id_ujian = u.id_ujian
      WHERE mp.id_paket_kursus = ?
    ");
                    $stmt_cek->bind_param('ss', $id_peserta, $peserta['id_jurusan']);
                  } else {
                    // cek single materi (privat/reguler_materi) + punya_ujian
                    $stmt_cek = $koneksi->prepare("
      SELECT m.punya_ujian, u.id_ujian, nu.nilai
      FROM materi m
      LEFT JOIN ujian u ON u.id_materi = m.id_materi AND u.id_peserta = ?
      LEFT JOIN nilai_ujian nu ON nu.id_ujian = u.id_ujian
      WHERE m.id_materi = ?
    ");
                    $stmt_cek->bind_param('ss', $id_peserta, $peserta['id_jurusan']);
                  }

                  $stmt_cek->execute();
                  $res_cek = $stmt_cek->get_result();

                  if ($res_cek->num_rows > 0) {
                    $boleh_ajukan = true;
                    while ($cm = $res_cek->fetch_assoc()) {
                      if ($cm['punya_ujian'] == 0) {
                        // Materi ini otomatis dianggap lulus, skip cek ujian
                        continue;
                      }
                      if ($cm['id_ujian'] === null || $cm['nilai'] === null || $cm['nilai'] === '') {
                        $boleh_ajukan = false;
                        break;
                      }
                      // Jika ada nilai tapi tidak lulus (<70), jangan boleh ajukan
                      if (is_numeric($cm['nilai']) && floatval($cm['nilai']) < 70) {
                        $boleh_ajukan = false;
                        break;
                      }
                    }
                  }
                  $stmt_cek->close();
                }

                if ($res_ajuan && $res_ajuan->num_rows > 0) {
                  $no = 1;
                  while ($aj = $res_ajuan->fetch_assoc()) {
                    $badge = 'secondary';
                    if ($aj['status'] == 'Proses') $badge = 'warning';
                    if ($aj['status'] == 'Selesai') $badge = 'success';
                    if ($aj['status'] == 'Ditolak') $badge = 'danger';

                    $namaJurusan = getNamaJurusan($koneksi, $aj['program'], $aj['id_jurusan']);

                    echo "<tr>
                    <td>" . $no . "</td>
                    <td>" . htmlspecialchars($namaJurusan) . "</td>
                    <td><span class='badge bg-" . $badge . "'>" . htmlspecialchars($aj['status']) . "</span></td>
                    <td>" . htmlspecialchars($aj['tanggal_pengajuan']) . "</td>
                  </tr>";
                    $no++;
                  }
                } else {
                  // tombol ajukan jika belum ada ajuan
                  echo "<tr>
                          <td colspan='4' class='text-center'>
                            <div class='text-center my-3'>
                              <form method='post' action='proses_fps.php'>
                                <input type='hidden' name='id_peserta' value='" . htmlspecialchars($peserta['id_peserta']) . "'>
                                <input type='hidden' name='program' value='" . htmlspecialchars($peserta['program'] ?? '') . "'>
                                <input type='hidden' name='id_jurusan' value='" . htmlspecialchars($peserta['id_jurusan'] ?? '') . "'>
                                <button type='submit' class='btn btn-primary' " .
                    (!$boleh_ajukan ? 'disabled' : '') . ">
                                  Ajukan Sertifikat
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>";
                }
                $stmt_ajuan->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Kalau Mencari Data Alumni -->
      <?php elseif ($peserta['sumber'] === 'alumni'): ?>
        <?php
        // Ambil nama jurusan, kalau kosong fallback ke field di DB
        $namaJurusan = getNamaJurusan($koneksi, $peserta['program'], $peserta['id_jurusan'])
          ?: ($peserta['nama_jurusan'] ?? null);
        ?>

        <!-- Judul -->
        <h2 class="text-center mb-4">
          Cek Data Alumni
          <?php if (!empty($peserta['nama_lengkap'])): ?>
            | <b><?= htmlspecialchars($peserta['nama_lengkap']) ?></b>
          <?php endif; ?>
        </h2>

        <!-- Data Sertifikat -->
        <div class="container">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              Data Sertifikat <?= htmlspecialchars($peserta['nama_lengkap'] ?? '-') ?>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-borderless">
                <tr>
                  <td style="width: 35%;"><strong>Nomor Induk</strong></td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; padding-left:0;"><?= htmlspecialchars($peserta['no_induk'] ?? '-'); ?></td>
                </tr>
                <tr>
                  <td style="width: 35%;"><strong>Nama</strong></td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; padding-left:0;"> <?= htmlspecialchars($peserta['nama_lengkap'] ?? '-') ?></td>
                </tr>
                <tr>
                  <td style="width: 35%;"><strong>Program</strong></td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; padding-left:0;"> <?= htmlspecialchars($namaJurusan ?: ($peserta['nama_jurusan'] ?? '-')) ?></td>
                </tr>
                <tr>
                  <td style="width: 35%;"><strong>Nomor Ujian</strong></td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; padding-left:0;"> <?= htmlspecialchars($peserta['no_ujian'] ?? '-') ?></td>
                </tr>
                <tr>
                  <td style="width: 35%;"><strong>Nomor Sertifikat</strong></td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; padding-left:0;"> <?= htmlspecialchars($peserta['no_sertifikat'] ?? '-') ?></td>
                </tr>
                <tr>
                  <td style="width: 35%;"><strong>Tanggal Lulus</strong></td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; padding-left:0;"> <?= htmlspecialchars($peserta['tanggal_lulus'] ?? '-') ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>


    <?php elseif ($id_peserta !== ''): ?>
      <div class="alert alert-danger">❌ Nomor Peserta tidak ditemukan.</div>
    <?php endif; ?>
    <div class="container">
      <div class="align-items-center justify-content-center"><a href="index" class="btn mt-3" style="background-color: #5fc580;">Kembali ke Beranda</a></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>