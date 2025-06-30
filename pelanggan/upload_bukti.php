<?php
include '../config/koneksi.php';
session_start();
$id_user = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesanan_id = $_POST['pesanan_id'];
    $file_name = date('YmdHis') . '_' . basename($_FILES['bukti']['name']);
    $tmp_name = $_FILES['bukti']['tmp_name'];
    $folder = "../bukti_pembayaran/" . $file_name;

    if (move_uploaded_file($tmp_name, $folder)) {
        mysqli_query($koneksi, "UPDATE pesanan SET bukti_bayar = '$file_name' WHERE id = $pesanan_id AND user_id = $id_user");
        echo "Upload berhasil!";
    } else {
        echo "Upload gagal!";
    }
}

$pesanan = mysqli_query($koneksi, "SELECT p.id, m.nama_minuman, p.status FROM pesanan p JOIN menu m ON p.menu_id = m.id WHERE p.user_id = $id_user");
?>
<h2>Upload Bukti Pembayaran</h2>
<form method="post" enctype="multipart/form-data">
    <label for="pesanan_id">Pilih Pesanan:</label><br>
    <select name="pesanan_id">
        <?php while ($row = mysqli_fetch_assoc($pesanan)) { ?>
        <option value="<?= $row['id'] ?>"><?= $row['nama_minuman'] ?> - Status: <?= $row['status'] ?></option>
        <?php } ?>
    </select><br><br>
    <label for="bukti">Upload Bukti (JPG/PNG/PDF):</label><br>
    <input type="file" name="bukti" required><br><br>
    <button type="submit">Upload</button>
</form>