<?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbName = "eie4432_project";

// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";
// mysqli_close($conn);
// echo "<br>";
// echo "Connection closed";