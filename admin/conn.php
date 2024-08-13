<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed");
}

echo "Connected to database successfully!";
?>