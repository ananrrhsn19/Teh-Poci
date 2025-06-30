<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pelanggan') {
    echo "Akses ditolak. Silakan login.";
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom right, #ffe0b2, #ffcc80);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-box {
        max-width: 600px;
        width: 100%;
        background: linear-gradient(to top, #fff3e0, #ffe0b2);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 4px 25px rgba(255, 153, 0, 0.3);
        text-align: center;
        border-top: 6px solid #ff851b;
    }

    h2 {
        color: #ff6f00;
        margin-bottom: 20px;
    }

    p {
        font-size: 16px;
        color: #333;
    }

    .btn-lg {
        padding: 12px 30px;
        font-size: 18px;
        border-radius: 12px;
        font-weight: 500;
    }

    .btn-orange {
        background-color: #ff851b;
        color: white;
        border: none;
    }

    .btn-orange:hover {
        background-color: #e67300;
    }

    .btn-outline-orange {
        background-color: white;
        color: #ff851b;
        border: 2px solid #ff851b;
    }

    .btn-outline-orange:hover {
        background-color: #ff851b;
        color: white;
    }

    .btn-logout {
        background-color: #e57373;
        color: white;
        border: none;
    }

    .btn-logout:hover {
        background-color: #d32f2f;
    }

    .icon {
        font-size: 24px;
        margin-right: 8px;
    }
    </style>
</head>

<body>

    <div class="dashboard-box">
        <h2>Dashboard Pelanggan</h2>
        <p>Halo, <strong><?= htmlspecialchars($nama) ?></strong> 👋</p>
        <p>Selamat datang di dashboard pelanggan.<br>Anda dapat memesan minuman atau melihat status pesanan Anda.</p>

        <div class="mt-4">
            <a href="pesan.php" class="btn btn-orange btn-lg mb-3">
                <span class="icon">🥤</span> Pesan Minuman
            </a><br>
            <a href="lihat_pesanan.php" class="btn btn-outline-orange btn-lg mb-3">
                <span class="icon">📋</span> Lihat Pesanan
            </a><br>
            <a href="logout.php" class="btn btn-logout btn-lg">
                <span class="icon">🚪</span> Logout
            </a>
        </div>
    </div>

</body>

</html>
