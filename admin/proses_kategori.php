<?php
include '../koneksi.php';
$aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : "";
if ($aksi == "insert") {
    if (isset($_POST['submit'])) {    
        $kategori = $_POST['kategori'];
        $keterangan = $_POST['keterangan'];
        $sql = mysqli_query($db, "INSERT INTO kategori_buku(kategori, keterangan) VALUES ('$kategori','$keterangan')");
        if ($sql) {
            header("location:./index.php?p=kategori"); //redirect
        } else {
            echo 'Data gagal disimpan';
        }
    }
}

if ($aksi == "hapus") {
    $id_hapus = isset($_GET['id']) ? $_GET['id'] : null;
    $sql = mysqli_query($db, "DELETE FROM kategori_buku WHERE id='$id_hapus'");
    if ($sql) {
        // echo "Data Berhasil dihapus";
        header("location:./index.php?p=kategori"); //redirect
    } else {
        print "Gagal menghapus data";
    }
}

if ($aksi == "update") {
    if (isset($_POST["submit"])) {
        $id = $_POST['id'];
        $kategori = $_POST['kategori'];
        $keterangan = $_POST['keterangan'];
        $sql = mysqli_query($db, "UPDATE kategori_buku SET kategori ='$kategori', keterangan='$keterangan' WHERE id='$id'");
        if ($sql) {
            header("location:./index.php?p=kategori");
        } else {
            echo "Data Gagal Diubah";
        }
    }
}
