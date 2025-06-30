<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$escaped_cari = mysqli_real_escape_string($koneksi, $cari);

$query = "SELECT p.*, u.nama AS nama_pelanggan, m.nama_minuman AS nama_menu 
          FROM pesanan p
          JOIN users u ON p.user_id = u.id
          JOIN menu m ON p.menu_id = m.id";

if (!empty($cari)) {
    $query .= " WHERE u.nama LIKE '%$escaped_cari%' OR m.nama_minuman LIKE '%$escaped_cari%'";
}

$query .= " ORDER BY p.tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background: linear-gradient(to bottom right, #ffe0b2, #ffcc80);
        font-family: 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .container-custom {
        background: linear-gradient(to top, #fff3e0, #ffe0b2);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(255, 140, 0, 0.2);
        margin-top: 50px;
        margin-bottom: 50px;
    }

    h2 {
        color: #ff6f00;
        font-weight: bold;
    }

    .table thead {
        background-color: #ff9800;
        color: white;
    }

    .btn-orange {
        background-color: #ff9800;
        color: white;
        border: none;
    }

    .btn-orange:hover {
        background-color: #f57c00;
    }

    .btn-outline-orange {
        color: #ff9800;
        border-color: #ff9800;
    }

    .btn-outline-orange:hover {
        background-color: #ff9800;
        color: white;
    }

    .btn-link {
        color: #ff6f00;
        font-weight: 500;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="container-custom">
            <h2 class="mb-4 text-center">Daftar Pesanan Pelanggan</h2>

            <form method="GET" class="form-inline mb-4 justify-content-center no-print">
                <input type="text" name="cari" class="form-control mr-2" placeholder="Cari nama/menu..."
                    value="<?= htmlspecialchars($cari) ?>" />
                <button type="submit" class="btn btn-orange mr-2">Cari</button>
                <a href="lihat_pesanan.php" class="btn btn-outline-orange mr-2">Reset</a>
                <button type="button" onclick="window.print()" class="btn btn-outline-orange mr-2">🖨 Print</button>
                <a href="dashboard.php" class="btn btn-link">← Kembali</a>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                            <th>Tanggal</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                            <td><?= htmlspecialchars($row['nama_menu']) ?></td>
                            <td><?= htmlspecialchars($row['jumlah']) ?></td>
                            <td><?= !empty($row['catatan']) ? htmlspecialchars($row['catatan']) : '-' ?></td>
                            <td><?= htmlspecialchars($row['tanggal']) ?></td>
                            <td>
                                <?php if (!empty($row['bukti_bayar'])): ?>
                                <a href="../uploads/<?= htmlspecialchars($row['bukti_bayar']) ?>" target="_blank">Lihat</a>
                                <?php else: ?>
                                <span class="text-muted">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pesanan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
