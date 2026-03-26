<?php

$host = "localhost";
$user = "root";
$password = "Natacha@MySql123";
$database = "Rental_Management_Database";
$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn){
    die("Connection failed");
}

