<?php
require 'logic.php';
if(isset($_POST["register"]) ) {
if( registrasi ($_POST) > 0) { echo "<script> alert('user baru berhasil ditambahkan!'); </script>";
} else {
echo mysqli_error($conn);
}
}
?><?php
include('koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tangkap_email = $_POST['email'];
    $tangkap_pass = $_POST['password'];

    $query = "INSERT INTO tb_pemakai (email, password) VALUES ('$tangkap_email', '$tangkap_pass')";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['user_aktif'] = $tangkap_email;
        header("location:login.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form action="register.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Daftar">
    </form>
</body>
</html>