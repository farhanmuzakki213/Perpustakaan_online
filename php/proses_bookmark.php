<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $buku_id = $_POST['buku_id'];

    // Periksa apakah buku sudah ada di favorit
    $result = mysqli_query($db, "SELECT * FROM favorit WHERE user_id=$user_id AND buku_id=$buku_id");
    if (mysqli_num_rows($result) > 0) {
        // Hapus dari favorit jika sudah ada
        mysqli_query($db, "DELETE FROM favorit WHERE user_id=$user_id AND buku_id=$buku_id");
        echo 'Buku dihapus dari favorit.';
    } else {
        // Tambahkan ke favorit jika belum ada
        mysqli_query($db, "INSERT INTO favorit (user_id, buku_id) VALUES ($user_id, $buku_id)");
        echo 'Buku ditambahkan ke favorit.';
    }
}
?>
