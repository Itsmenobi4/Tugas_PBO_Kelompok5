<?php
require 'connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RacaMarket</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
    <div class="container">
    <nav class="navbar">
        <div class="logo">NextGens</div>
        <ul class="nav-links">
            <li><a href="produk.php">Home</a></li>
            <li><a href="index.php">Produk</a></li>
            <?php if (isset($_SESSION["login"])) : ?>
                <li><a href="riwayat.php">Riwayat Transaksi</a></li>
                <li><a href="setting.php">Settings</a></li>
                <li><button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="logout()">Logout</button></li>
            <?php else : ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    

    <script>
    function logout() {
        Swal.fire({
            title: "Yakin ingin logout?",
            text: "Anda harus login kembali jika keluar.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, logout!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php";
            }
        });
    }
    </script>
</body>
</html>
