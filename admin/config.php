<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("connection failed: " . mysqli_connect_error());
}
// echo "connected successfully";
