<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin:  http://localhost/filesharing/get_data.php');
header('Access-Control-Allow-Origin:  http://localhost/filesharing/homepage.html');
header('Access-Control-Allow-Origin:  http://localhost/filesharing/upload.php');


$query = "SELECT * FROM filemanager";
$result = mysqli_query($koneksi, $query);
$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($data);
?>
