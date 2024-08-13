<?php

$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "slbqasite"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_coonect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    // Menampilkan pesan kesalahan yang lebih informatif
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form
$user = $_POST['username'];
$pass = $_POST['password'];

// Mencari user di database
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User ditemukan
    echo "Login berhasil!";
} else {
    // User tidak ditemukan
    echo "Username atau password salah.";
}

$conn->close();
?>