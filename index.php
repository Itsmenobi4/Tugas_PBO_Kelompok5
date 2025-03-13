<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'header.php';

$produk = query("SELECT * FROM produk");

if (isset($_POST["cari"])) {
    $produk = cari($_POST["keyword"]);
}
?>

<div class="flex justify-between items-center mb-5">
    <form method="POST" class="flex gap-2 bg-white p-3 rounded-lg shadow-md">
        <input type="text" name="keyword" placeholder="Cari produk..." class="border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" name="cari" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Cari</button>
    </form>
    
    <div class="flex gap-3">
        <a href="tambah_produk.php">
            <button class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition">Tambah Produk</button>
        </a>
        <a href="beli.php">
            <button class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition">Beli</button>
        </a>
    </div>
</div>

<h2 class="text-2xl font-semibold text-indigo-700 mb-3">🎁 Daftar Produk</h2>

<table class="w-full border-collapse border border-gray-300 rounded-lg overflow-hidden shadow-md">
    <tr class="bg-indigo-600 text-white">
        <th class="p-3 border">No.</th>
        <th class="p-3 border">Aksi</th>
        <th class="p-3 border">Nama</th>
        <th class="p-3 border">Harga</th>
        <th class="p-3 border">Stok</th>
        <th class="p-3 border">Foto</th>
    </tr>

    <?php $i = 1; ?>
    <?php if (empty($produk)) : ?>
        <tr>
            <td colspan="6" class="text-center p-4">Tidak ada produk</td>
        </tr>
    <?php else : ?>
        <?php foreach ($produk as $row) : ?>
        <tr class="border border-gray-300">
            <td class="p-3 border"><?= $i++; ?></td>
            <td class="p-3 border">
                <a href="edit.php?id=<?= $row['id']; ?>" class="bg-purple-500 text-white px-4 py-2 rounded-md text-lg font-semibold hover:bg-purple-600 transition">Edit</a>
                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition" onclick="hapusProduk(<?= $row['id']; ?>)">Hapus</button>
            </td>
            <td class="p-3 border"><?= $row["nama"]; ?></td>
            <td class="p-3 border">Rp <?= number_format($row["harga"]); ?></td>
            <td class="p-3 border"><?= $row["stok"]; ?></td>
            <td class="p-3 border">
                <img src="<?= $row["foto"]; ?>" alt="Produk" class="w-20 h-20 object-cover rounded-md">
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function hapusProduk(id) {
    Swal.fire({
        title: 'Yakin mau hapus?',
        text: "Kenangan ini ga bisa balik lagi lhoo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'iyaa yakin!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete.php?id=' + id;
        }
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<?php require 'footer.php'; ?>
