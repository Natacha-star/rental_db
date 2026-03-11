<?php
include '../auth/check_login.php';
include '../db_connect.php';

if ($_SESSION['role'] !== 'customer') {
    header("Location: list.php"); // Only customers can book
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$customer_id = $_SESSION['user_id'];
$today = date('Y-m-d');

// Verify if the property is still available
$check_sql = "SELECT status FROM Properties WHERE property_id = $id AND status = 'Available'";
$check_res = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_res) > 0) {
    // 1. Insert into Rentals
    $sql_rental = "INSERT INTO Rentals (property_id, customer_id, start_date, payment_status) 
                   VALUES ($id, $customer_id, '$today', 'Pending')";
    
    if (mysqli_query($conn, $sql_rental)) {
        // 2. Update Property Status
        $sql_property = "UPDATE Properties SET status = 'Rented' WHERE property_id = $id";
        mysqli_query($conn, $sql_property);
        
        header('Location: list.php?msg=booked');
        exit;
    } else {
        echo "Error creating rental: " . mysqli_error($conn);
    }
} else {
    header('Location: list.php?error=unavailable');
    exit;
}
?>
