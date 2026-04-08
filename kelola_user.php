<?php
include 'koneksi.php';

// Ambil data User
$user_q = mysqli_query($koneksi, "SELECT * FROM user");

?>
<div class="pagetitle">
  <h1>Kelola User</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
      <li class="breadcrumb-item active">Kelola User</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card">
  <div class="card-body overflow-x-scroll overflow-y-scroll">
    <h5 class="card-title">Data User</h5>

    <!-- Tabel Data User -->
    <table class="table datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Nama Lengkap</th>
          <th>Email</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        while ($data = mysqli_fetch_assoc($user_q)) {
          $no++;
        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['email']; ?></td>
            <td><?= $data['role']; ?></td>
            <td>
              <a href="?url=edit_user&id_user=<?= $data['id_user']; ?> " class="btn btn-success"><i class="bi bi-pencil-square"></i></a> |
              <a href="?url=hapus_user&id_user=<?= $data['id_user']; ?> " class="btn btn-danger" onclick="confirmDelete(this)"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- End Tabel Data User -->
  </div>
</div>

<!-- Form Tambah User -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Tambah User</h5>

    <!-- Horizontal Form -->
    <form method="post" action="tambah_user.php">
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputText" name="username">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="input-group col-sm-5 w-75">
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
          <span class="input-group-text" onclick="togglePassword()">
            <i class="bi bi-eye" id="toggleIcon"></i>
          </span>
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputPassword" name="nama">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputPassword" name="email">
        </div>
      </div>
      <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Role</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="admin">
            <label class="form-check-label" for="gridRadios1">
              Admin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="petugas">
            <label class="form-check-label" for="gridRadios2">
              Petugas
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="instruktur">
            <label class="form-check-label" for="gridRadios2">
              Instruktur
            </label>
          </div>
        </div>
      </fieldset>
      <div class="text-center">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-secondary">Kosongkan</button>
      </div>
    </form><!-- End Horizontal Form -->
  </div>
</div><!-- End Form Tambah User -->
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
</script>
<script>
  function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.classList.remove("bi-eye");
      toggleIcon.classList.add("bi-eye-slash");
    } else {
      passwordInput.type = "password";
      toggleIcon.classList.remove("bi-eye-slash");
      toggleIcon.classList.add("bi-eye");
    }
  }
</script>