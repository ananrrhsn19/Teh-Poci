<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pelanggan') {
    echo "Akses ditolak. Silakan login.";
    exit;
}

include '../koneksi.php';

$id_user = $_SESSION['user_id'];
$menu = mysqli_query($koneksi, "SELECT * FROM menu");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = $_POST['menu_id'];
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    // Hitung total harga
    $menu_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM menu WHERE id=$menu_id"));
    $total = $jumlah * $menu_data['harga'];

    // Upload bukti pembayaran
    if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === 0) {
        $bukti = time() . '_' . $_FILES['bukti']['name']; // rename unik
        $bukti_tmp = $_FILES['bukti']['tmp_name'];
        $upload_path = '../uploads/';
        move_uploaded_file($bukti_tmp, $upload_path . $bukti);
    } else {
        $bukti = '';
    }

    // Simpan ke tabel pesanan
    $query = "INSERT INTO pesanan (user_id, menu_id, jumlah, total_harga, metode_pembayaran, status, tanggal, bukti_bayar) 
              VALUES ('$id_user', '$menu_id', '$jumlah', '$total', '$metode', 'Diproses', NOW(), '$bukti')";
    
    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        echo "<div class='alert alert-success text-center mt-3'>Pesanan berhasil disimpan!</div>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Gagal menyimpan pesanan: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Minuman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to bottom right, #ffe0b2, #ffcc80);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }

    .form-box {
        max-width: 650px;
        margin: 60px auto;
        background: linear-gradient(to top, #fff3e0, #ffe0b2);
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(255, 153, 0, 0.25);
        border-top: 6px solid #ff9800;
    }

    h3 {
        color: #ff6f00;
        font-weight: 600;
        margin-bottom: 30px;
    }

    label {
        font-weight: 500;
    }

    .btn-success {
        background-color: #ff9800;
        border: none;
    }

    .btn-success:hover {
        background-color: #fb8c00;
    }

    .btn-secondary {
        background-color: #ffa726;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #f57c00;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h3 class="text-center">Form Pemesanan Minuman</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="menu_id">Pilih Varian</label>
                    <select name="menu_id" id="menu_id" class="form-control" required onchange="hitungTotal()">
                        <option value="">-- Pilih Varian --</option>
                        <?php
                        mysqli_data_seek($menu, 0);
                        while ($row = mysqli_fetch_assoc($menu)) {
                            echo "<option value='{$row['id']}' data-harga='{$row['harga']}'>
                                {$row['nama_minuman']} — Rp" . number_format($row['harga']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required
                        onchange="hitungTotal()">
                </div>

                <div class="form-group">
                    <label for="metode">Metode Pembayaran</label>
                    <select name="metode" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="OVO">OVO</option>
                        <option value="Dana">Dana</option>
                        <option value="Tunai">Tunai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah_bayar">Total Bayar (Rp)</label>
                    <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="bukti">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti" class="form-control-file" required>
                </div>

                <button type="submit" class="btn btn-success btn-block">Pesan & Bayar</button>
                <a href="dashboard.php" class="btn btn-secondary btn-block">Kembali</a>
            </form>
        </div>
    </div>

    <script>
    function hitungTotal() {
        const menuSelect = document.getElementById('menu_id');
        const harga = parseInt(menuSelect.options[menuSelect.selectedIndex]?.getAttribute('data-harga')) || 0;
        const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
        const total = harga * jumlah;
        document.getElementById('jumlah_bayar').value = total.toLocaleString('id-ID');
    }
    </script>
</body>

</html>
