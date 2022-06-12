<?php
$servername = "localhost";
$username = "root";
$pwd = "";
$bdd = "tiendam2022";

// Create connection
$conn = new mysqli($servername, $username, $pwd, $bdd);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>