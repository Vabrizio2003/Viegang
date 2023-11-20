<!-- File ini berisi koneksi dengan database MySQL -->
<?php 

// (1) Buatlah variable untuk connect ke database yang telah di import ke phpMyAdmin
$host = "localhost:3306";
$user = "root";
$pass = "";
$name = "modul4";


$koneksi = mysqli_connect($host, $user, $pass,$name);
// 

// (2) Buatlah perkondisian untuk menampilkan pesan error ketika database gagal terkoneksi


 
?>