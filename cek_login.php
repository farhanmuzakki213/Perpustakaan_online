<?php
if (isset($_POST['submit'])) {
    include 'koneksi.php';

    $user = mysqli_real_escape_string($db, $_POST['username']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $pass_hash = md5($pass);

    $cek_login = mysqli_query($db, "SELECT * FROM user WHERE username='$user' AND password='$pass_hash'");
    $hasil_login = mysqli_num_rows($cek_login);
    $data_user = mysqli_fetch_array($cek_login);

    if ($hasil_login > 0) {
        session_start();
        $_SESSION['login'] = TRUE;
        $_SESSION['id_user'] = $data_user['id_user'];
        $_SESSION['email'] = $data_user['email'];
        $_SESSION['username'] = $data_user['username'];
        $_SESSION['level'] = $data_user['level'];
        $_SESSION['password'] = $data_user['password'];

        if ($_SESSION['level'] == 'admin') {
            header('location:admin/index.php');
        } else {
            header('location:index.php');
        }
    } else {
        echo "<script>alert('Login Invalid'); 
        window.location='./index.php?p=login'</script>";
        
    }
}

?>
