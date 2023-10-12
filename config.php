<?php 
$servername = "localhost"; //server database
$username = "root"; // username database
$password = ""; // password database
$dbname = "db_crud"; // nama database

// Koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Cek Koneksi
if ($koneksi->connect_error){
    die("Connection failed: " . $koneksi->connect_error);
}

?>