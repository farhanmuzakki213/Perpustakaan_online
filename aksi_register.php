<?php

include 'koneksi.php';

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Ubah menjadi MD5

    $sql = "INSERT INTO user (username, email, password) VALUES ('$name', '$email', '$password')";

    if ($db->query($sql) === TRUE) {
        // Registration successful
        echo "<script>alert('Registration successful!'); location='./index.php?p=login'</script>";
    } else {
        // Registration failed
        echo "<script>alert('Registration failed!'); location='./index.php?p=register';</script>";
    }

    // Close the database connection
    $db->close();
}
?>

