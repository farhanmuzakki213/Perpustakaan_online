<?php
include '../koneksi.php';
$aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : "";
if ($aksi == "insert") {
    if (isset($_POST['submit'])) {    
        $judul = $_POST['judul'];
        $penerbit = $_POST['penerbit'];
        $pengarang = $_POST['pengarang'];
        $tgl = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl_terbit'];
        $deskripsi = $_POST['deskripsi'];
        $jml_hal = $_POST['jml_hal'];
        $bahasa = $_POST['bahasa'];
        $jml_buku = $_POST['jml_buku'];

         // Upload gambar
        $targetDir = "../assets/images/upload/"; // Sesuaikan dengan direktori tempat Anda ingin menyimpan gambar
        $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Cek apakah file gambar valid
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo '<script>alert("File bukan gambar."); </script>';
            $uploadOk = 0;
        }

        // Batasi ukuran file
        if ($_FILES["gambar"]["size"] > 500000) {
            echo '<script>alert("Maaf, ukuran file terlalu besar."); </script>';
            $uploadOk = 0;
        }

        // Izinkan hanya beberapa tipe file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo '<script>alert("Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan."); </script>';
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                $namaFile = basename($_FILES["gambar"]["name"]);


                $sql = mysqli_query($db, "INSERT INTO buku(id_kategori, judul, penerbit, pengarang, tgl_terbit, deskripsi, jml_hal, bahasa, gambar , tersedia ) VALUES ('$_POST[id_kategori]','$judul','$penerbit','$pengarang','$tgl','$deskripsi','$jml_hal','$bahasa','$namaFile', '$jml_buku')");

                if ($sql) {
                    echo '<script>alert("Data Berhasil disimpan"); window.location.href = "./index.php?p=databuku";</script>';
                } else {
                    echo '<script>alert("Gagal Menyimpan data"); </script>';
                }
            } else {
                echo '<script>alert("Maaf, terjadi kesalahan saat mengupload file."); </script>';
            }
        } else {
            echo '<script>alert("Maaf, file tidak diupload."); </script>';
        }
    }
}

if ($aksi == "hapus") {
    $id_hapus = isset($_GET['id']) ? $_GET['id'] : null;
    $sql = mysqli_query($db, "DELETE FROM buku WHERE id='$id_hapus'");
    if ($sql) {
        header("location:./index.php?p=databuku");
    } else {
        print "Gagal menghapus data";
    }
}

if ($aksi == "update") {
    if (isset($_POST["submit"])) {
        $id = $_POST['id'];
        $id_kategori = $_POST['id_kategori'];
        $judul = $_POST['judul'];
        $penerbit = $_POST['penerbit'];
        $pengarang = $_POST['pengarang'];
        $tgl_terbit = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl_terbit'];
        $deskripsi = $_POST['deskripsi'];
        $jml_hal = $_POST['jml_hal'];
        $bahasa = $_POST['bahasa'];
        $jml_buku = $_POST['jml_buku'];

        if (isset($_FILES["gambar"]["name"]) && $_FILES["gambar"]["name"] != "") {
            // Upload gambar baru
            $targetDir = "../assets/images/upload/";
            $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo '<script>alert("File Ini Bukan Gambar");</script>';
                $uploadOk = 0;
            }

            if ($_FILES["gambar"]["size"] > 50000000) {
                echo '<script>alert("Maaf, ukuran file terlalu besar.");</script>';
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                $dataLama = mysqli_query($db, "SELECT gambar FROM buku WHERE id='$id'");
                $rowLama = mysqli_fetch_assoc($dataLama);
                $gambarLama = $rowLama['gambar'];
                if ($gambarLama != "") {
                    unlink("../assets/images/upload/" . $gambarLama);
                }

                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                    $namaFile = basename($_FILES["gambar"]["name"]);

                    $sql = "UPDATE buku SET id_kategori=?, judul=?, penerbit=?, pengarang=?, tgl_terbit=?, deskripsi=?, jml_hal=?, bahasa=?, gambar=?, tersedia=? WHERE id=?";

                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("isssssissii", $id_kategori, $judul, $penerbit, $pengarang, $tgl_terbit, $deskripsi, $jml_hal, $bahasa, $namaFile, $jml_buku, $id);
                    $result = $stmt->execute();

                    if ($result) {
                        echo '<script>alert("Berhasil Merubah Keseluruhan data"); window.location.href = "index.php?p=databuku";</script>';
                    } else {
                        echo '<script>alert("Gagal Merubah Keseluruhan data"); </script>';
                    }
                } else {
                    echo '<script>alert("Maaf, terjadi kesalahan saat mengupload file."); </script>';
                }
            } else {
                echo '<script>alert("Maaf, file tidak diupload."); </script>';
            }
        } else {
            $sql = "UPDATE buku SET id_kategori=?, judul=?, penerbit=?, pengarang=?, tgl_terbit=?, deskripsi=?, jml_hal=?, bahasa=? ,tersedia=? WHERE id=?";

            $stmt = $db->prepare($sql);
            $stmt->bind_param("isssssisii", $id_kategori, $judul, $penerbit, $pengarang, $tgl_terbit, $deskripsi, $jml_hal, $bahasa, $jml_buku, $id);
            $result = $stmt->execute();

            if ($result) {
                echo '<script>alert("Berhasil Merubah data"); window.location.href = "index.php?p=databuku";</script>';
            } else {
                echo '<script>alert("Gagal Merubah data"); </script>';
            }
        }
    }
}
