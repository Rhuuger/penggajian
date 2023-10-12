<?php
    include('koneksi.php');
    SESSION_START();

    $tangkap_email = $_POST['email'];
    $tangkap_pass = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT nama FROM tb_pemakai
     WHERE email = '$tangkap_email' AND password='$tangkap_pass' ");

    $baris = mysqli_num_rows($query);

    if($baris == 1){
        $data = mysqli_fetch_array($query);
        $_SESSION['user_aktif'] = $data['nama'];
        header("location:home.php");
    }
    else {
        echo"Maaf Email/Password Anda Salah";   
    }
?>
<br>
<br>
    <input type="submit" value="Ulangi" onclick="location.href='login.php'">