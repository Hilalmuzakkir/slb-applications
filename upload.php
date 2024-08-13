<?php
$servername = "localhost";
$username = "username"; // ganti dengan username database Anda
$password = "password"; // ganti dengan password database Anda
$dbname = "database_name"; // ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek apakah file diupload
if (isset($_POST["submit"])) {
    $target_dir = "uploads/"; // folder untuk menyimpan file
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["fileToUpload"]["size"] > 500000) { // 500KB
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Cek format file
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek apakah $uploadOk di-set ke 0 oleh kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file tidak diupload.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " telah diupload.";

            // Simpan informasi file ke database
            $sql = "INSERT INTO files (filename) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "')";
            if ($conn->query($sql) === TRUE) {
                echo "Informasi file disimpan ke database.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}

$conn->close();
?>
