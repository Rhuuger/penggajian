<?php 
require 'logic.php';

$students = runQuery("SELECT * FROM students");

// Pagination
// Konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(runQuery("SELECT * FROM students"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$students = runQuery("SELECT * FROM students LIMIT $awalData, $jumlahDataPerHalaman");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
            <h1>Data Siswa!</h1>
            <a href="create.php">
                <h3>
                    Tambah Data
                </h3>
                </a>
                <!-- Navigasi -->
                <br><br>
                <a href="?halaman=1">Awal</a>

                <?php if($halamanAktif > 1) : ?>
                    <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                <?php endif; ?>

                <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
                    <?php if($i == $halamanAktif): ?>
                        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            
                <a href="?halaman=<?= $halamanAktif; ?>">akhir</a>
            <br>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1;?>
            <?php foreach ($students as $student) : ?>
            <tr>
                    <td><?= $i++;?></td>
                    <td><?= $student["nama"]?></td>
                    <td><?= $student["kelas"]?></td>
                    <td><?= $student["alamat"]?></td>
                    <td>
                        <?php if(!empty($student["gambar"])): ?>
                            <img src="img/<?= $student["gambar"]; ?>" width="50">
                        <?php else: ?>
                            <img src="img/default.png" width="50"> <!-- Gambar default jika tidak ada gambar -->
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href='update.php?id=<?= $student["id"]; ?>'>Ubah</a>
                        |
                        <a href="delete.php?id=<?= $student["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach;?>
        </table>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2023 Hak Cipta Dilindungi</p>
    </div>
</body>
</html>