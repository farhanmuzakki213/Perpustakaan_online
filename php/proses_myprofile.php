<?php
include '../koneksi.php';
$aksi = isset($_GET["aksi"]) ? $_GET["aksi"] : "";

if ($aksi == "ubahprofile") {
    if (isset($_POST['submit'])) {    
        $id_user = $_POST['id_user'];
        $id_a = $_POST['id_a'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['notelp'];
        
        $cek_data=mysqli_query($db, "SELECT * FROM anggota WHERE id_user = '$id_user'");
        if(mysqli_num_rows($cek_data) > 0){
            $sql =  "UPDATE anggota SET nama='$nama', alamat='$alamat' , no_telp= '$no_telp' WHERE id_a = '$id_a'";

            if (mysqli_query($db, $sql)) {
                echo '<script>
                alert("data berhasil diperbarui");
                window.location.href = "../index.php?p=profile";
                </script>';
            } else {
                echo 'Data gagal disimpan';
            }
        }else{
            $sql = "INSERT INTO anggota (id_user, nama, alamat, no_telp) 
                    VALUES ('$id_user', '$nama', '$alamat', '$no_telp')";

            if (mysqli_query($db, $sql)) {
                echo '<script>
                alert("data berhasil diperbarui");
                window.location.href = "../index.php?p=profile";
                </script>';
            } else {
                echo 'Data gagal disimpan';
            }
        }
    }
}





if ($aksi == "ubahpass") {
    if (isset($_POST["submit"])) {
        $id_user = $_POST['id_user'];
        $password_lama = md5($_POST['password_lama']);
        $password_baru = md5($_POST['password_baru']);
        $password_ulang = md5($_POST['password_ulang']);
        $password = $_POST['password'];

        if ($password_lama == $password) {
            if ($password_baru == $password_ulang) {
                $sql = mysqli_query($db, "UPDATE user SET 
                                            password='$password_baru'
                                            WHERE id_user='$id_user'");
                if ($sql) {
                    ?>
                    <script>
                        alert("Password berhasil diubah");
                        window.location.href = "../index.php?p=profile";
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        alert("Data Gagal Diubah");
                        window.location.href = "../index.php?p=profile";
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    alert("Password baru dan password ulang tidak sesuai.");
                    window.location.href = "../index.php?p=profile";
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Password lama tidak sesuai.");
                window.location.href = "../index.php?p=profile";
            </script>
            <?php
        }
    }
}
?>





