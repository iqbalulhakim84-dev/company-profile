<?php
include 'koneksi.php';
$id_user = $_GET['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);

?>
<div class="pagetitle">
  <h1>Kelola Pengguna</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item"><a href="dashboard.php?url=kelola_user.php">Kelola Pengguna</a></li>
      <li class="breadcrumb-item active">Edit Pengguna</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Edit Pengguna</h5>

    <!-- Horizontal Form -->
    <form method="post" action="simpan_user.php">
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputText" name="username" value="<?= $data['username']; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $data['nama']; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $data['email']; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input
              type="password"
              class="form-control"
              id="inputPassword"
              name="password"
              value="<?= htmlspecialchars($data['password']); ?>">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

      <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
          const pwd = document.getElementById('inputPassword');
          const icon = this.querySelector('i');

          if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
          } else {
            pwd.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
          }
        });
      </script>

      <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Role</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="admin"
              <?php if ($data['role'] == 'Admin') print "checked"; ?>>
            <label class="form-check-label" for="gridRadios1">
              Admin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="instruktur"
              <?php if ($data['role'] == 'Instruktur') print "checked"; ?>>
            <label class="form-check-label" for="gridRadios2">
              Instruktur
            </label>
          </div>
        </div>
      </fieldset>
      <div class="text-center">
        <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
        <button type="submit" class="btn btn-primary">Edit</button>
        <button type="reset" class="btn btn-secondary">Kosongkan</button>
      </div>
    </form><!-- End Horizontal Form -->

  </div>
</div>