<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #e9fdf0;
        /* hijau muda */
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #4CAF50;
        color: white;
        padding: 20px;
        text-align: center;
        font-size: 24px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .container {
        padding: 40px;
        max-width: 800px;
        margin: 0 auto;
    }

    .card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        margin: 10px 5px 0 0;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #45a049;
    }

    footer {
        text-align: center;
        padding: 20px;
        font-size: 14px;
        color: #666;
    }
    </style>
</head>

<body>

    <header>
        Dashboard Admin - Es Teh Poci
    </header>

    <div class="container">
        <div class="card">
            <h3>Selamat datang, Admin!</h3>
            <p>Gunakan tombol di bawah untuk mengelola data pesanan dan bukti pembayaran.</p>
            <a href="lihat_pesanan.php" class="btn">Lihat Semua Pesanan</a>
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>

    <footer>
        &copy; <?= date('Y') ?> Es Teh Poci | Sistem Informasi Pemesanan
    </footer>

</body>

</html>