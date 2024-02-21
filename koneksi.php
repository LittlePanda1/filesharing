<?php
  
$dbHost = 'localhost';
$dbName = 'filemanagerdb';
$dbUsername = 'root';
$dbPassword = '';
  
$koneksi = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (mysqli_connect_error()){
    echo("Maaf web tidak tersambung ke server");
} 
?>