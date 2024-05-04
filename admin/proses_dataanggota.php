<?php
include '../koneksi.php';
$aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : "";
if ($aksi == "insert") {
    if (isset($_POST['submit'])) {    
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['notelp'];
        $sql = mysqli_query($db, "INSERT INTO anggota(id_user,nama,alamat,no_telp) 
                                                            VALUES ('$_POST[id_user]','$nama','$alamat','$no_telp')");
        if ($sql) {
            header("location:./index.php?p=dataanggota"); //redirect
        } else {
            echo 'Data gagal disimpan';
        }
    }
}

if ($aksi == "hapus") {
    $id_hapus = isset($_GET['id']) ? $_GET['id'] : null;
    $cek_data=mysqli_query($db, "SELECT * FROM peminjaman WHERE id_anggota = '$id_hapus'");
    if(mysqli_num_rows($cek_data) > 0){
        echo '<script>alert("Maaf, anggota masih meminjam buku!!!");window.location.href = "./index.php?p=dataanggota"; </script>';
    }else{
        $sql = mysqli_query($db, "DELETE FROM anggota WHERE id_a='$id_hapus'");
        if ($sql) {
            header("location:./index.php?p=dataanggota");
        } else {
            echo '<script>alert("Maaf, gagal menghapus data!!!"); </script>';
        }
    }
}

if ($aksi == "update") {
    if (isset($_POST["submit"])) {
        $id_a = $_POST['id_a'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['notelp'];
        $sql = mysqli_query($db, "UPDATE anggota SET 
                                    nama='$nama',
                                    alamat ='$alamat', 
                                    no_telp='$no_telp' 
                                    WHERE id_a='$id_a'");
        if ($sql) {
            header("location:./index.php?p=dataanggota");
        } else {
            echo "Data Gagal Diubah";
        }
    }
}
