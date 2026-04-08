<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data user dari database
$stmt = $koneksi->prepare("SELECT nama, username, role FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password']; // boleh kosong

    if (!empty($password)) {
        // Update dengan password baru
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $update = $koneksi->prepare("UPDATE user SET nama=?, username=?, password=? WHERE id_user=?");
        $update->bind_param("sssi", $nama, $username, $hash, $id_user);
    } else {
        // Update tanpa ubah password
        $update = $koneksi->prepare("UPDATE user SET nama=?, username=? WHERE id_user=?");
        $update->bind_param("ssi", $nama, $username, $id_user);
    }

    if ($update->execute()) {
        $_SESSION['nama'] = $nama; // update session juga
        $_SESSION['username'] = $username;
        if ($_SESSION['role'] == 'Admin') {
            $_SESSION['alert'] = [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Profil berhasil diperbarui.'
            ];
            header("Location: dashboard.php"); // arahkan kembali ke dashboard
            exit;
        } else {
            $_SESSION['alert'] = [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Profil berhasil diperbarui.'
            ];
            header("Location: dashboard_instruktur.php"); // arahkan kembali ke dashboard
            exit;
        }
    } else {
        echo "Gagal update profil: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Profil</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logolpkii.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>
    <main style="background-color: #f1ececff;">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3 shadow-lg border-0">
                                <div class="card-body">
                                    <h5 class="card-title text-center mb-3" style="color: #FFD700;">Edit Profil</h5>
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-4 col-form-label">Password Baru</label>
                                            <div class="input-group col-sm-6">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                                <span class="input-group-text" onclick="togglePassword()">
                                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="admin"
                                                        <?php if ($user['role'] == 'Admin') print "checked"; ?>>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Admin
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="instruktur"
                                                        <?php if ($user['role'] == 'Instruktur') print "checked"; ?>>
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Instruktur
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                        <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
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

</body>

</html>