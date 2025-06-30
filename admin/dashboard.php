<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-xxx" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    body {
        background: linear-gradient(to bottom right, #ffe0b2, #ffcc80);
        font-family: 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .navbar {
        background-color: #ff9800;
    }

    .navbar-brand,
    .nav-link,
    .btn-logout {
        color: white !important;
    }

    .btn-logout {
        border: 1px solid white;
        padding: 6px 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .btn-logout:hover {
        background-color: #fb8c00;
    }

    .dashboard-container {
        max-width: 450px;
        margin: 70px auto;
        padding: 30px;
        background: linear-gradient(to top, #fff3e0, #ffe0b2);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(255, 140, 0, 0.2);
        text-align: center;
        border-top: 6px solid #ff9800;
    }

    .icon-circle {
        width: 65px;
        height: 65px;
        background-color: #ff9800;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 26px;
        margin: 0 auto 20px;
    }

    .btn-orange {
        background-color: #ff9800;
        color: white;
        border: none;
        width: 100%;
        font-weight: 500;
        padding: 12px;
        border-radius: 8px;
        transition: background 0.3s ease;
    }

    .btn-orange:hover {
        background-color: #f57c00;
    }

    h5 {
        color: #ff6f00;
        font-weight: bold;
    }

    p {
        color: #333;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#"><i class="fas fa-mug-hot mr-2"></i>Teh Poci Admin</a>
            <div class="ml-auto">
                <a href="../logout.php" class="btn-logout"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <div class="icon-circle"><i class="fas fa-user-cog"></i></div>
        <h5 class="mb-3">Halo, Admin Teh Poci Kertonyono</h5>
        <p>Selamat datang di dashboard admin. Klik tombol di bawah untuk melihat pesanan pelanggan.</p>
        <a href="lihat_pesanan.php" class="btn btn-orange mt-3">
            <i class="fas fa-list-alt mr-2"></i>Lihat Pesanan
        </a>
    </div>

</body>

</html>
