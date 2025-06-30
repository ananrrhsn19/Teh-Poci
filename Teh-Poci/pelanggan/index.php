<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan</title>
    <style>
    body {
        background-color: #e8fbe9;
        font-family: Arial, sans-serif;
        margin: 0;
    }

    header {
        background-color: #4caf50;
        color: white;
        padding: 15px;
        text-align: center;
    }

    .container {
        margin: 40px auto;
        width: 90%;
        max-width: 600px;
        background-color: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #388e3c;
    }

    a.button {
        display: inline-block;
        padding: 12px 20px;
        margin-top: 20px;
        background-color: #66bb6a;
        color: white;
        text-decoration: none;
        border-radius: 6px;
    }

    a.button:hover {
        background-color: #58a65a;
    }
    </style>
</head>

<body>
    <header>
        <h1>Selamat Datang, Pelanggan</h1>
    </header>
    <div class="container">
        <h2>Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h2>
        <p>Anda berhasil login sebagai pelanggan.</p>

        <a class="button" href="pesan.php">+ Buat Pesanan Baru</a><br>
        <a class="button" href="../logout.php" style="background-color:#e53935; margin-top: 15px;">Logout</a>
    </div>
</body>

</html>