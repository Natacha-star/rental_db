<?php
include '../db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM Properties WHERE property_id = $id";
if (mysqli_query($conn, $sql)) {
    header('Location: list.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>