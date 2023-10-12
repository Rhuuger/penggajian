<?php 
require 'logic.php'; //asumsikan logic.php adalah file yang berisi fungsi create()

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $result = create($_POST);

    if($result){
        header('location: students.php');
        exit; // Penting untuk memanggil exit() setelah header() untuk menghentikan eksekusi skrip
    } else {
        echo "Failed to add data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="container">
            <ul>
                <li><a href="index.php">BERANDA</a></li>
                <li><a href="students.php">SISWA</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div>
                <form action="" id="crud" method="post" enctype="multipart/form-data">
                    <h1 style="text-align: center;">Tambah Data</h1>
                    <br>
                    <label for="name">Nama:</label><br>
                    <input type="text" id="name" name="name"><br>
                    <label for="grade">Kelas:</label><br>
                    <input type="grade" id="grade" name="grade"><br>
                    <label for="alamat">Alamat:</label><br>
                    <input type="text" id="alamat" name="address"><br>
                    <label for="image">Upload Gambar:</label><br>
                    <input type="file" name="gambar" id="gambar"><br>

                    <button type="submit">Tambah Data</button>
                    <br>
                        <a href="students.php" style="text-align: center;">Halaman Siswa</a>
                </form>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2023 Hak Cipta Dilindungi</p>
    </div>
</body>
</html>