<?php
include 'koneksi.php';

// Ambil data Pendaftar
$pendaftar = mysqli_query(
    $koneksi,
    "SELECT p.*,
        CASE 
            WHEN p.program = 'privat' THEN (SELECT mp.nama_materi FROM daftar_materi_privat mp WHERE mp.id_daftar_materi_privat = p.id_jurusan)
            WHEN p.program = 'reguler_materi' THEN (SELECT mr.nama_materi FROM daftar_materi_reguler mr WHERE mr.id_daftar_materi_reguler = p.id_jurusan)
            WHEN p.program = 'reguler_paket' THEN (SELECT pk.nama_paket FROM paket_kursus pk WHERE pk.id_paket_kursus = p.id_jurusan)
        END AS nama_jurusan
    FROM pendaftar p
    ORDER BY tgl DESC
"
);


?>
<div class="pagetitle">
    <h1>Kelola Pendaftar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item active">Kelola Pendaftar</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <h5 class="card-title position-absolute ms-4">Data Pendaftar</h5><br><br>
    <div class="card-body overflow-x-scroll overflow-y-scroll">

        <!-- Tabel Data Pendaftar -->
        <table class="table table-bordered" style="width: max-content;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat Sekarang</th>
                    <th>Kode Pos Sekarang</th>
                    <th>No. Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Pendidikan Terakhir</th>
                    <th>Lulusan Tahun</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat Perusahaan</th>
                    <th>Kode Pos Perusahaan</th>
                    <th>No. Telp Perusahaan</th>
                    <th>Jabatan</th>
                    <th>Nama Orang Tua/ Wali</th>
                    <th>Alamat Orang Tua / Wali</th>
                    <th>Kode Pos Orang Tua / Wali</th>
                    <th>No. Telp Orang Tua / Wali</th>
                    <th>Program</th>
                    <th>Jurusan</th>
                    <th>Tgl Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_assoc($pendaftar)) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nisn']; ?></td>
                        <td><?= $data['nik']; ?></td>
                        <td><?= $data['nama_lengkap']; ?></td>
                        <td><?= $data['tempat_lahir']; ?></td>
                        <td><?= $data['tanggal_lahir']; ?></td>
                        <td><?= $data['alamat_sekarang']; ?></td>
                        <td><?= $data['kode_pos']; ?></td>
                        <td><?= $data['no_hp']; ?></td>
                        <td><?= $data['jk']; ?></td>
                        <td><?= $data['agama']; ?></td>
                        <td><?= $data['pendidikan_terakhir']; ?></td>
                        <td><?= $data['lulusan_tahun']; ?></td>
                        <td><?= $data['nama_perusahaan']; ?></td>
                        <td><?= $data['alamat_perusahaan']; ?></td>
                        <td><?= $data['kode_pos_perusahaan']; ?></td>
                        <td><?= $data['no_telp_perusahaan']; ?></td>
                        <td><?= $data['jabatan']; ?></td>
                        <td><?= $data['nama_orangtua']; ?></td>
                        <td><?= $data['alamat_orangtua']; ?></td>
                        <td><?= $data['kode_pos_orangtua']; ?></td>
                        <td><?= $data['no_telp_orangtua']; ?></td>
                        <td><?= $data['program']; ?></td>
                        <td><?= $data['nama_jurusan']; ?></td>
                        <td><?= $data['tgl']; ?></td>
                        <td>
                            <a href="approve_pendaftar.php?id_pendaftar=<?= htmlspecialchars($data['id_pendaftar']); ?>" class="btn btn-primary" style="font-size: 0.8rem;" onclick="confirmApprove(this)"><i class="bi bi-check" style="font-size: medium;"></i></a> |
                            <a href="?url=edit_pendaftar&id_pendaftar=<?= $data['id_pendaftar']; ?> " class="btn btn-success" style="font-size: 0.8rem;"><i class="bi bi-pencil-square" style="font-size: medium;"></i></a> |
                            <a href="?url=hapus_pendaftar&id_pendaftar=<?= htmlspecialchars($data['id_pendaftar']); ?> " class="btn btn-danger" style="font-size: 0.8rem;" onclick="confirmDelete(this)"><i class="bi bi-trash" style="font-size: medium;"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- End Tabel Data Pendaftar -->
    </div>
</div>
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

    function confirmApprove(el) {
        event.preventDefault(); // cegah redirect langsung
        let href = el.getAttribute('href'); // ambil URL dari tombol

        Swal.fire({
            title: 'Setujui pendaftar ini menjadi peserta?',
            text: "Pastikan semua syarat terpenuhi.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'rgba(51, 128, 221, 1)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    }
</script>