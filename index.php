<?php
session_start();

// Jika belum login, arahkan ke login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek role dan redirect ke halaman dashboard sesuai role
if ($_SESSION['role'] == 'admin') {
    header("Location: admin/index.php");
} else {
    header("Location: pelanggan/index.php");
}
exit;