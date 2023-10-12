<?php 

require 'config.php';

// Buat function runQuery, ini digunakan untuk menjalankan query table
// Membuat parameter query untuk menangkap script yang dikirim
function runQuery($query){
    // Panggil variable koneksi
    // Variable global
    global $koneksi;

    // Buat variable result
    // query() bawaan dari objek tersebut untuk menjalankan perintah SQL.
    // $koneksi->query($query); ->query() adalah metode dari objek $koneksi
    $result = $koneksi->query($query);

    // Buat kondisi jika terdapat error saat pemanggilan
    if(!$result){
        die ("Query Error: ".$koneksi->errno." - ".$koneksi->error);
    }

    // Siapkan kotak kosong
    // Berupa variable array
    // Untuk menampung banyak data
    $rows = [];

    // Lakukan pengulangan
    // Memanggil data yang dipecah
    while ($row = $result->fetch_assoc()){
        // Simpan hasil fetch
        // Kedalam kotak kosong yang sudah disiapkan
        $rows[] = $row;
    }

// Mengembalikan $rows
    return $rows;
}

// Membuat method create
// Menyimpan parameter $data
function create($data){
    // Memanggil variable koneksi
    global $koneksi;
    // var_dump($data["name]); die();

    // Menangkap nama dari input form
    // Membersihkan karakter dengan htmlspecialchars
    $name = htmlspecialchars($data["name"]);
    $grade = htmlspecialchars($data["grade"]);
    $address = htmlspecialchars($data["address"]);

    // Upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $stmt = $koneksi->prepare("INSERT INTO students (nama, kelas, alamat, gambar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $grade, $address, $gambar);

    // Menjalankan eksekusi query
    if($stmt->execute()){
        return $stmt->affected_rows;
    } else {
        echo "Error: " . $stmt->error;
        return false;
    }
}

// Membuat fungsi upload
function upload(){
    // Atribut dari input type file/form enctype :
    // Nama file, kenapa nama file kita kelola ?
    $namaFile = $_FILES['gambar']['name'];
    // Ukuran file, kenapa ukuran file kita kelola ?
    $ukuranFile = $_FILES['gambar']['size'];
    // Error, kenapa error kita kelola ?
    $error = $_FILES['gambar']['error'];

    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    // === / sama dengan 3, a === 1, apakah di kotak a isinya angka 1
    // Dan tipe datanya sama
    // == / sama dengan 2, a == 1, apakah di kotak a isinya angka 1
    // Kalau bukan maka menghasilkan false/0, kalo iya true/1
    // = sama dengan 1, a = 1, a diisi 1
    // a = "Jack",
    if($error === 4){
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // Explode, maksudnya memecah string menjadi array
    $ekstensiGambar = explode('.', $namaFile);
    // strtolower, mengatur huruf kecil semua
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // Jika didalam array tidak ada nama gambar diikuti ekstensinya
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if($ukuranFile > 3000000){
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // Lolos pengecekan, gambar siap diupload
    // Generate nama gambar baru
    // Supaya nama gambar unik
    $namaFileBaru = uniqid();
    // .= atinya disambung dengan titik
    $namaFileBaru .= '.';
    // Disambung lagi dengan ekstensi gambar
    $namaFileBaru .= $ekstensiGambar;

    // Perintah memindahkan file yang sudah ada di temporary file
    // Ke folder yang kita buat/img sekaligus nama file baru
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function update($data){
    global $koneksi;
    // var_dump($data); die;
    $id = htmlspecialchars($data["id"]);
    $name = htmlspecialchars($data["name"]);
    $grade = htmlspecialchars($data["grade"]);
    $address = htmlspecialchars($data["address"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $stmt = $koneksi->prepare("UPDATE students SET nama = ?, kelas = ?, alamat = ?, gambar = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $grade, $address, $gambar, $id);

    if($stmt->execute()){
        header('Location: students.php');
        exit; // Penting untuk memanggil exit() setelah header() untuk menghentikan eksekusi skrip
    } else {
        echo "Error: " . $stmt->error;
        return false;
    }
}

function delete($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM students WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}
?>