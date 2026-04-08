<?php
include 'koneksi.php';

$id_materi = $_GET['id_materi'] ?? 0;

// Pakai prepared statement
$stmt = $koneksi->prepare("SELECT * FROM materi WHERE id_materi = ?");
$stmt->bind_param("i", $id_materi);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();
?>

<div class="pagetitle">
    <h1>Kelola Materi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_materi.php">Kelola Materi</a></li>
            <li class="breadcrumb-item active">Edit Materi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Materi</h5>

        <!-- Horizontal Form -->
        <form method="post" action="simpan_materi.php">
            <div class="row mb-3">
                <label for="namaMateri" class="col-sm-2 col-form-label">Nama Materi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaMateri" 
                           name="nama_materi" value="<?= htmlspecialchars($data['nama_materi']); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Punya Ujian?</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="punya_ujian" id="punyaUjianYa" value="1" 
                            <?= ($data['punya_ujian'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="punyaUjianYa">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="punya_ujian" id="punyaUjianTidak" value="0" 
                            <?= ($data['punya_ujian'] == 0) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="punyaUjianTidak">Tidak</label>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="id_materi" value="<?= $data['id_materi']; ?>">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <button type="reset" class="btn btn-secondary">Kosongkan</button>
            </div>
        </form><!-- End Horizontal Form -->
    </div>
</div>
