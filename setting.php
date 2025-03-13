<?php
require 'header.php';

// Cek dulu sebelum session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$user = query("SELECT * FROM users WHERE id = $user_id");

// Pastikan data user ada, kalau tidak kasih nilai default
$user_username = isset($user[0]["username"]) ? $user[0]["username"] : "";
$user_email = isset($user[0]["email"]) ? $user[0]["email"] : "";

if (isset($_POST["update_profile"])) {
    $username = $_POST["username"]; // Sesuaikan dengan name di form
    $email = $_POST["email"];

    query("UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id");
    echo "<script>Swal.fire('Berhasil!', 'Profil berhasil diperbarui!', 'success');</script>";
}

if (isset($_POST["update_password"])) {
    $password_lama = $_POST["password_lama"];
    $password_baru = $_POST["password_baru"];
    $password_konfirmasi = $_POST["password_konfirmasi"];

    if (password_verify($password_lama, $user[0]["password"])) {
        if ($password_baru === $password_konfirmasi) {
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            query("UPDATE users SET password = '$password_hash' WHERE id = $user_id");
            echo "<script>Swal.fire('Berhasil!', 'Password berhasil diperbarui!', 'success');</script>";
        } else {
            echo "<script>Swal.fire('Gagal!', 'Konfirmasi password tidak cocok!', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Gagal!', 'Password lama salah!', 'error');</script>";
    }
}
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">⚙️ Pengaturan</h2>
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md">
        <label class="block mb-2">Nama:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user_username) ?>" class="border px-3 py-2 rounded-md w-full mb-3">
        
        <label class="block mb-2">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user_email) ?>" class="border px-3 py-2 rounded-md w-full mb-3">
        
        <button type="submit" name="update_profile" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Profil</button>
    </form>
    
    <h3 class="text-xl font-semibold mt-6">🔒 Ubah Password</h3>
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md mt-4">
        <label class="block mb-2">Password Lama:</label>
        <input type="password" name="password_lama" class="border px-3 py-2 rounded-md w-full mb-3">
        
        <label class="block mb-2">Password Baru:</label>
        <input type="password" name="password_baru" class="border px-3 py-2 rounded-md w-full mb-3">
        
        <label class="block mb-2">Konfirmasi Password:</label>
        <input type="password" name="password_konfirmasi" class="border px-3 py-2 rounded-md w-full mb-3">
        
        <button type="submit" name="update_password" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Update Password</button>
    </form>
</div>

<?php require 'footer.php'; ?>
