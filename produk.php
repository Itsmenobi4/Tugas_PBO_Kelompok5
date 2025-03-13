<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login dulu!'); window.location.href='login.php';</script>";
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #6a5acd;
        }
        .container {
            text-align: center;
            background: none;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        h1 {
            color: #6a5acd;
        }
        .navbar {
    background: #7b68ee;
    padding: 15px 20px;
    display: flex;
    justify-content: left;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
}

.logo {
    font-size: 20px;
    font-weight: bold;
    color: white;
    margin-right: 12px;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
    justify-content: right 15px;
}

.nav-links li {
    display: inline;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.nav-links a:hover {
    background: rgba(255, 255, 255, 0.2);
}

.logout-link {
    background: #d32f2f;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background 0.3s ease;
    margin-left: fit-content;
}

.logout-link:hover {
    background: #b71c1c;
}

    </style>
</head>
<body>
        <nav class="navbar">
    <div class="logo">NextGens</div>
    <ul class="nav-links">
        <li><a href="produk.php">Home</a></li>
        <li><a href="index.php">Produk</a></li>
        <?php if (isset($_SESSION["login"])) : ?>
            <li><a href="riwayat.php">Riwayat Transaksi</a></li>
            <li><a href="logout.php" class="logout-link">Logout</a></li>
        <?php else : ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
<div class="container">
    <h1>Halo, <?= htmlspecialchars($username); ?>! 👋</h1>
    <p>Selamat datang di NextGens</p>
    <p>Anda membeli tiket dengan mudah di sini.</p>
    <p>Temukan tiket yang anda perlukan!</p>
</div>

</body>
</html>

<?php include 'footer.php'; ?>
