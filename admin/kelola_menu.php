<?php
include '../config/koneksi.php';
session_start();
if ($_SESSION['role'] !== 'admin') exit("Akses ditolak");

if ($_POST) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    mysqli_query($koneksi, "INSERT INTO menu (nama_minuman, harga) VALUES ('$nama', '$harga')");
}

$menu = mysqli_query($koneksi, "SELECT * FROM menu");
?>
<form method="post">
    Nama Minuman: <input name="nama"><br>
    Harga: <input name="harga"><br>
    <button type="submit">Tambah</button>
</form>
<hr>
<h3>Daftar Menu:</h3>
<ul>
    <?php while ($m = mysqli_fetch_assoc($menu)) {
    echo "<li>{$m['nama_minuman']} - Rp{$m['harga']}</li>";
} ?>
</ul>