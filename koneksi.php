<?php
$koneksi = mysqli_connect("localhost", "root", "", "es_teh_poci");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}