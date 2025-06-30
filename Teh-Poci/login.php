<?php
session_start();
include 'koneksi.php';

$pesan_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $pesan_error = 'Username dan password tidak boleh kosong.';
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        
        if ($query && mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['user_id'] = $user['id']; 


            if ($user['role'] === 'admin') {
                header('Location: admin/dashboard.php');
                exit;
            } elseif ($user['role'] === 'pelanggan') {
                header('Location: pelanggan/dashboard.php');
                exit;
            } else {
                $pesan_error = 'Role tidak dikenali.';
            }
        } else {
            $pesan_error = 'Username atau password salah.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Sistem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #e6ffe6;
    }

    .login-box {
        max-width: 400px;
        margin: 100px auto;
        padding: 30px;
        border-radius: 10px;
        background-color: #fff;
        border: 1px solid #28a745;
    }
    </style>
</head>

<body>
    <div class="login-box shadow">
        <h3 class="text-center text-success">Login Sistem</h3>
        <?php if ($pesan_error): ?>
        <div class="alert alert-danger"><?= $pesan_error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
        </form>
    </div>
</body>

</html>