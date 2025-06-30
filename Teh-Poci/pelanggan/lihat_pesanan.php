<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pelanggan') {
    echo "Akses ditolak. Silakan login sebagai pelanggan.";
    exit;
}

include '../koneksi.php';

$user_id = $_SESSION['user_id'];

// Ambil data pesanan user yang sedang login
$query = "SELECT p.*, m.nama_minuman FROM pesanan p
          JOIN menu m ON p.menu_id = m.id
          WHERE p.user_id = '$user_id'
          ORDER BY p.tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan Anda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background: linear-gradient(to bottom right, #ffe0b2, #ffcc80);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .container-custom {
        background: linear-gradient(to top, #fff3e0, #ffe0b2);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(255, 140, 0, 0.2);
        margin-top: 60px;
        margin-bottom: 40px;
    }

    h3 {
        color: #ff6f00;
        font-weight: bold;
    }

    .table thead {
        background-color: #ffb74d;
        color: #fff;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .badge-info {
        background-color: #ffa726;
    }

    .btn-secondary {
        background-color: #ff9800;
        border: none;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background-color: #fb8c00;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="container-custom">
            <h3 class="text-center mb-4">Daftar Pesanan Anda</h3>

            <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Minuman</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Metode Bayar</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Bukti Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_minuman']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td>Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['metode_pembayaran']) ?></td>
                        <td><span class="badge badge-info"><?= $row['status'] ?></span></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td>
                            <?php if (!empty($row['bukti_bayar'])): ?>
                            <a href="../uploads/<?= htmlspecialchars($row['bukti_bayar']) ?>" target="_blank">Lihat</a>
                            <?php else: ?>
                            <span class="text-muted">Belum ada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="alert alert-warning text-center">Belum ada pesanan yang dibuat.</div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>
