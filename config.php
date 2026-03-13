<?php
// config.php
$host = "localhost";
$user = "root";          // change if needed
$pass = "";              // XAMPP default is empty
$db   = "subhvaishali_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
?>
