<?php
include 'koneksi.php';
$id_ujian = $_GET['id_ujian'];
$query = mysqli_query($koneksi, "SELECT 
        u.id_ujian, 
        u.tgl_ujian, 
        u.no_pc, 
        u.ket,
        m.nama_materi, 
        p.nama_lengkap,
        p.id_peserta
    FROM ujian u
    INNER JOIN materi m ON u.id_materi = m.id_materi
    INNER JOIN peserta p ON u.id_peserta = p.id_peserta
    ORDER BY u.id_ujian DESC");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id_ujian'])) {
        die('Parameter id_ujian tidak ditemukan.');
    }
    $id_ujian = (int) $_GET['id_ujian'];

    // Ambil data ujian yang mau diedit
    $stmt = $koneksi->prepare("SELECT id_ujian, tgl_ujian, id_materi, no_pc, ket FROM ujian WHERE id_ujian = ?");
    $stmt->bind_param("i", $id_ujian);
    $stmt->execute();
    $result = $stmt->get_result();
    $ujian = $result->fetch_assoc();
    if (!$ujian) {
        die('Data ujian tidak ditemukan.');
    }

    // Ambil data referensi untuk dropdown
    $materi_q  = $koneksi->query("SELECT id_materi, nama_materi FROM materi ORDER BY nama_materi ASC");
    $peserta_q = $koneksi->query("SELECT id_peserta, nama_lengkap FROM peserta ORDER BY nama_lengkap ASC");
}
?>
<div class="pagetitle">
    <h1>Kelola Ujian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_ujian.php">Kelola Ujian</a></li>
            <li class="breadcrumb-item active">Edit Ujian</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Ujian</h5>

        <!-- Horizontal Form -->
        <form method="post" action="simpan_ujian.php" class="needs-validation" novalidate>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label fw-bold">Nama Peserta</label>
                <div class="col-sm-9">
                    <select class="form-select" name="id_peserta" required>
                        <option value="">-- Pilih Peserta --</option>
                        <?php while ($peserta = mysqli_fetch_assoc($peserta_q)) {
                            $selected = ($peserta['id_peserta'] == $ujian['id_peserta']) ? 'selected' : '';
                        ?>
                            <option value="<?= $peserta['id_peserta'] ?>" <?= $selected ?>>
                                <?= htmlspecialchars($peserta['nama_lengkap']) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Silakan pilih peserta.</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label fw-bold">Materi Ujian</label>
                <div class="col-sm-9">
                    <select class="form-select" name="id_materi" required>
                        <option value="">-- Pilih Materi --</option>
                        <?php while ($materi = mysqli_fetch_assoc($materi_q)) {
                            $selected = ($materi['id_materi'] == $ujian['id_materi']) ? 'selected' : '';
                        ?>
                            <option value="<?= $materi['id_materi'] ?>" <?= $selected ?>>
                                <?= htmlspecialchars($materi['nama_materi']) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Silakan pilih materi ujian.</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label fw-bold">Tanggal Ujian</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tgl_ujian"
                        value="<?= htmlspecialchars($ujian['tgl_ujian']); ?>" required>
                    <div class="invalid-feedback">Silakan pilih tanggal ujian.</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label fw-bold">Nomor PC</label>
                <div class="col-sm-9">
                    <select class="form-select" name="no_pc" required>
                        <option value="" disabled>-- Pilih No PC --</option>
                        <?php for ($i = 1; $i <= 14; $i++) {
                            $pc_value = "PC-$i";
                            $selected = ($pc_value == $ujian['no_pc']) ? 'selected' : '';
                        ?>
                            <option value="<?= $pc_value ?>" <?= $selected ?>><?= $pc_value ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Silakan pilih nomor PC.</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label fw-bold">Keterangan</label>
                <div class="col-sm-9">
                    <select class="form-select" name="ket" required>
                        <option value="" disabled>-- Pilih Keterangan --</option>
                        <option value="Ujian Pertama" <?= ($ujian['ket'] == "Ujian") ? "selected" : "" ?>>Ujian Pertama</option>
                        <option value="Remedial" <?= ($ujian['ket'] == "Remedial") ? "selected" : "" ?>>Remedial</option>
                    </select>
                    <div class="invalid-feedback">Silakan pilih keterangan ujian.</div>
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="id_ujian" value="<?= $ujian['id_ujian']; ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form>

        <script>
            // Bootstrap validation
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>

        <!-- End Horizontal Form -->

    </div>
</div>