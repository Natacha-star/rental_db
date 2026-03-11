<?php
include '../auth/check_login.php';
if ($_SESSION['role'] !== 'landlord') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $sql = "DELETE FROM Customers WHERE customer_id = $id";
    mysqli_query($conn, $sql);
}

header('Location: list.php');
exit;
?>