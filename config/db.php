<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lost_found_db";
$port = 3306;

$conn = new mysqli($servername,$username,$password,$dbname,$port);

if($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}
?>