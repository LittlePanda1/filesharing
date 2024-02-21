<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["filetoUpload"]["name"]);
    $uploadOk = 1;

    if ($_FILES["filetoUpload"]["size"] > 500000) {
        echo "<script>alert('Maaf, ukuran file terlalu besar.');</script>";
        echo "<script>window.location.href = 'homepage.html';</script>";
        exit();
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["filetoUpload"]["tmp_name"], $targetFile)) {
            $namaFile = basename($_FILES["filetoUpload"]["name"]);
            $descFile = mysqli_real_escape_string($koneksi, $_POST["desc"]);
            $queryCount = "SELECT COUNT(*) as total FROM filemanager";
            $resultCount = mysqli_query($koneksi, $queryCount);
            $row = mysqli_fetch_assoc($resultCount);
            $noFile = $row['total'] + 1;
            $idFile = generateRandomID();

            $query = "INSERT INTO filemanager (no, id, nama_file, date, description) VALUES ('$noFile', '$idFile', '$namaFile', NOW(), '$descFile')";
            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('File " . $namaFile . " telah diunggah dan informasinya dimasukkan ke dalam database.');</script>";
                echo "<script>window.location.href = 'homepage.html';</script>";
                echo "<script>location.reload();</script>";
                exit();
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat memasukkan informasi file ke dalam database: " . mysqli_error($koneksi) . "');</script>";
                echo "<script>window.location.href = 'homepage.html';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.');</script>";
            echo "<script>window.location.href = 'homepage.html';</script>";
            exit();
        }
    }
}


function generateRandomID() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
?>
