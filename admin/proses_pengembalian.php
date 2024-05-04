<?php
include '../koneksi.php';
$aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : "";
if ($aksi == "insert") {
    if (isset($_POST['submit'])) {
        $tgl_pengembalian = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_pengembalian'];
        $status = $_POST['status'];
        $denda = $_POST['denda'];
        $sql = mysqli_query($db, "INSERT INTO pengembalian(id_peminjaman, tanggal_pengembalian, denda, status2) 
                                                            VALUES ('$_POST[id_peminjaman]','$tgl_pengembalian','$denda','$status')");

        
        if ($sql) {
            header("location:./index.php?p=pengembalian"); 
        } else {
            echo 'Data gagal disimpan';
        }
    }
}

if ($aksi == "hapus") {
    $id_hapus = isset($_GET['id']) ? $_GET['id'] : null;
    $sql = mysqli_query($db, "DELETE FROM pengembalian WHERE id_pm='$id_hapus'");
    if ($sql) {
        header("location:./index.php?p=pengembalian"); 
    } else {
        print "Gagal menghapus data";
    }
}

if ($aksi == "update") {
    if (isset($_POST["submit"])) {
        $id_pm = $_POST['id_pm'];
        $tgl_pengembalian = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tanggal_pengembalian'];
        $status = $_POST['status2'];
        $denda = $_POST['denda'];

    $sql = "UPDATE pengembalian SET tanggal_pengembalian=?, denda=?, status2=?  WHERE id_pm=?";


    $stmt = $db->prepare($sql);
    $stmt->bind_param("sisi",  $tgl_pengembalian ,$denda, $status, $id_pm);
    $result = $stmt->execute();
        if ($sql) {
            header("location:./index.php?p=pengembalian");
        } else {
            echo "Data Gagal Diubah";
        }
    }
}
