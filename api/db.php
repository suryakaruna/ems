<?php
$conn = new mysqli("localhost", "root", "","ems");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

