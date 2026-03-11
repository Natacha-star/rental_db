<?php
// Database connection file
$host = "localhost";
$user = "root";
$password = "Natacha@MySql123";
$database = "rental_management_database";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>