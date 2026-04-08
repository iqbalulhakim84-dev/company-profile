<?php
include 'koneksi.php';

$type = $_GET['type'] ?? 'foto';
$result = mysqli_query($koneksi, "SELECT * FROM galeri WHERE tipe='$type' ORDER BY id_galeri ASC");

$no = 0;
while ($data = mysqli_fetch_assoc($result)) {
    if ($no % 4 == 0) echo '<div class="container"><div class="row g-4 justify-content-center px-2" style="margin-top: 30px;">';
?>
    <div class="col-sm-3 text-center">
        <div class="card mb-3 animate__animated animate__fadeIn">
            <?php if ($type === 'foto'): ?>
                <img src="assets/img/galeri/<?= $data['gambar']; ?>" class="card-img-top" alt="<?= $data['nama_galeri']; ?>">
            <?php else: ?>
                <video class="w-100" controls>
                    <source src="assets/img/galeri/vidio/<?= $data['video']; ?>" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?= $data['nama_galeri']; ?></h5>
            </div>
        </div>
    </div>
<?php
    $no++;
    if ($no % 4 == 0) echo '</div></div>';
}
if ($no % 4 != 0) echo '</div></div>'; // tutup row terakhir
?>