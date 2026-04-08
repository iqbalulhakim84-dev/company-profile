<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT a.id_ajuan, a.status, a.tanggal_pengajuan, 
       COALESCE(pk.nama_paket, dm.nama_materi, drm.nama_materi) AS nama_materi,
       p.nama_lengkap, p.id_peserta, p.program, p.id_jurusan
FROM ajuan_sertifikat a
LEFT JOIN peserta p ON a.id_peserta = p.id_peserta
LEFT JOIN daftar_materi_privat dm ON (p.program='privat' AND p.id_jurusan = dm.id_daftar_materi_privat)
LEFT JOIN daftar_materi_reguler drm ON (p.program='reguler_materi' AND p.id_jurusan = drm.id_daftar_materi_reguler)
LEFT JOIN paket_kursus pk ON (p.program='reguler_paket' AND p.id_jurusan = pk.id_paket_kursus)
ORDER BY a.tanggal_pengajuan DESC;

");
?>

<div class="pagetitle">
    <h1>Kelola Pengajuan Sertifikat</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Pengajuan Sertifikat</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body overflow-x-scroll overflow-y-scroll">
        <h5 class="card-title">Data Pengajuan Sertifikat</h5>

        <!-- Tabel Galeri -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Peserta</th>
                    <th>Program</th>
                    <th>Materi/Paket</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Data Peserta</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $badge = "secondary";
                        if ($row['status'] == "Proses") $badge = "warning";
                        if ($row['status'] == "Selesai") $badge = "success";
                        if ($row['status'] == "Ditolak") $badge = "danger";

                        echo "<tr>
                                <td>{$row['nama_lengkap']}</td>
                                <td>{$row['program']}</td>
                                <td>{$row['nama_materi']}</td>
                                <td>{$row['tanggal_pengajuan']}</td>
                                <td><a href='?url=detail_peserta&id_peserta={$row['id_peserta']}' class='btn btn-warning'><i class='bi bi-eye'></i></a></td>
                                <td><span class='badge bg-{$badge}'>{$row['status']}</span></td>
                                <td>";
                        if ($row['status'] == "Proses") {
                            echo "
                            <button type=\"button\" class=\"btn btn-success btn-sm\" 
                                    onclick=\"approveCertificate('{$row['id_ajuan']}', '{$row['id_peserta']}')\">
                                Setujui
                            </button>
                            <form method='post' action='proses_ps.php' class='d-inline'>
                                <input type='hidden' name='id_ajuan' value='{$row['id_ajuan']}'>
                                <input type='hidden' name='aksi' value='Ditolak'>
                                <button type='submit' class='btn btn-danger btn-sm'>Tolak</button>
                            </form>
                            ";
                        } else {
                            echo "<i>Tidak ada aksi</i>";
                        }
                        echo "</td></tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Belum ada ajuan sertifikat.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- End Tabel Pengajuan Sertifikat -->

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function approveCertificate(idAjuan, idPeserta) {
        Swal.fire({
            title: 'Setujui Sertifikat',
            html: `
            <input type="text" id="no_induk" class="swal2-input" placeholder="Nomor Induk Peserta">
            <input type="text" id="no_sertifikat" class="swal2-input" placeholder="Nomor Sertifikat">
            <input type="text" id="no_ujian" class="swal2-input" placeholder="Nomor Ujian">
        `,
            confirmButtonText: 'Simpan',
            showCancelButton: true,
            preConfirm: () => {
                const noSertifikat = document.getElementById('no_sertifikat').value;
                const noInduk = document.getElementById('no_induk').value;
                const noUjian = document.getElementById('no_ujian').value;
                if (!noSertifikat || !noInduk) {
                    Swal.showValidationMessage('Nomor sertifikat dan nomor induk wajib diisi!');
                    return false;
                }
                return {
                    noSertifikat: noSertifikat,
                    noInduk: noInduk,
                    noUjian: noUjian
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // kirim data ke proses_ps.php via POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'proses_ps.php';

                form.innerHTML = `
                <input type="hidden" name="id_ajuan" value="${idAjuan}">
                <input type="hidden" name="id_peserta" value="${idPeserta}">
                <input type="hidden" name="aksi" value="Selesai">
                <input type="hidden" name="no_sertifikat" value="${result.value.noSertifikat}">
                <input type="hidden" name="no_induk" value="${result.value.noInduk}">
                <input type="hidden" name="no_ujian" value="${result.value.noUjian}">
            `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>