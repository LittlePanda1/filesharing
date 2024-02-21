<?php
$valid_username = "admin" ;
$valid_password = "root";
$username = $_POST['usn'];
$password = $_POST['pw'];

if ($username === $valid_username && $password === $valid_password) {
    header("Location: /homepage.html");
    exit();
} else {
    header("Location: /index.html?error=1");
    exit();
}
?>
