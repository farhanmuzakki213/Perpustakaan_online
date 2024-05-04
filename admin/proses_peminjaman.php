<?php
include '../koneksi.php';
$aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : "";
if ($aksi == "insert") {
    if (isset($_POST['submit'])) {
        $tgl_pinjam = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_pinjam'];
        $tgl_kembali = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_kembali'];
        $status = $_POST['status'];
        $sql = mysqli_query($db, "INSERT INTO peminjaman(id_buku,id_anggota,tanggal_pinjam, tanggal_kembali, status1) 
                                                            VALUES ('$_POST[id_buku]','$_POST[id_anggota]','$tgl_pinjam','$tgl_kembali','$status')");

        
        if ($sql) {
            header("location:./index.php?p=peminjaman"); //redirect
        } else {
            echo 'Data gagal disimpan';
        }
    }
}

if ($aksi == "hapus") {
    $id_hapus = isset($_GET['id']) ? $_GET['id'] : null;
    $sql = mysqli_query($db, "DELETE FROM peminjaman WHERE id='$id_hapus'");
    if ($sql) {
        // echo "Data Berhasil dihapus";
        header("location:./index.php?p=peminjaman"); //redirect
    } else {
        print "Gagal menghapus data";
    }
}

if ($aksi == "update") {
    if (isset($_POST["submit"])) {
        $id = $_POST['id'];
        $id_buku = $_POST['id_buku'];
        $id_anggota = $_POST['id_anggota'];
        $tgl_pinjam = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_pinjam'];
        $tgl_kembali = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_kembali'];
        $status = $_POST['status'];

    $sql = "UPDATE peminjaman SET id_buku=?, id_anggota=?, tanggal_pinjam=?, tanggal_kembali=?, status1=? WHERE id=?";


    $stmt = $db->prepare($sql);
    $stmt->bind_param("iisssi", $id_buku, $id_anggota, $tgl_pinjam, $tgl_kembali, $status, $id);
    $result = $stmt->execute();
        if ($sql) {
            header("location:./index.php?p=peminjaman");
        } else {
            echo "Data Gagal Diubah";
        }
    }
}

if ($aksi == "ajukan") {
    if (isset($_POST['submit'])) {
        $tgl_pinjam = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_pinjam'];
        $tgl_kembali = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_kembali'];
        $sql = mysqli_query($db, "INSERT INTO peminjaman(id_buku,id_anggota,tanggal_pinjam, tanggal_kembali) 
                                                            VALUES ('$_POST[id_buku]','$_POST[id_anggota]','$tgl_pinjam','$tgl_kembali')");

        
        if ($sql) {
            header("location:../index.php?p=daftarbuku"); //redirect
        } else {
            echo 'Data gagal disimpan';
        }
    }
}