<?php 
require 'logic.php';

$student = null;
// Mengambil id siswa dari URL
if (isset($_GET['id'])){
    $id = $_GET['id'];
    // Menggunakan fungsi query untuk mendapatkan detail siswa
    $student = runQuery("SELECT * FROM students WHERE id = $id")[0];
}
// var_dump($student['name]); die;

// Memeriks apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // var_dump($_POST); die;
    $result = update($_POST);

    if ($result !== false && $result > 0){
        echo "Data has been successfully updated";
    } else {
        echo "Failed to update data";
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
                    <input type="hidden" name="id" value="<?= $student['id']; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
                    <h1 style="text-align: center;">Ubah Data</h1>
                    <br>
                    <label for="name">Nama:</label><br>
                    <input type="text" id="name" name="name" value="<?= $student['nama']; ?>"><br>
                    <label for="grade">Kelas:</label><br>
                    <input type="grade" id="grade" name="grade" value="<?= $student['kelas']; ?>"><br>
                    <label for="alamat">Alamat:</label><br>
                    <input type="text" id="alamat" name="address" value="<?= $student['alamat']; ?>"><br>
                    <label for="image">Upload Gambar:</label><br>
                    <img src="img/<?= $student['gambar']; ?>" width="50"><br>
                    <input type="file" name="gambar" id="gambar"><br>

                    <button type="submit">Ubah Data</button>
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