<?php
include '../db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM Customers WHERE customer_id = $id";
if (mysqli_query($conn, $sql)) {
    header('Location: list.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>