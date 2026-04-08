<?php
$koneksi = mysqli_connect("localhost", "root", "", "pkl_lpkii");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>