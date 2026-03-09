<?php
$page_title = 'Edit Rental';
include '../header.php';
include '../db_connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Rentals WHERE rental_id = $id";
$result = mysqli_query($conn, $sql);
$rental = mysqli_fetch_assoc($result);

// Fetch properties
$properties_sql = "SELECT property_id, title FROM Properties ORDER BY title";
$properties_result = mysqli_query($conn, $properties_sql);

// Fetch customers
$customers_sql = "SELECT customer_id, full_name FROM Customers ORDER BY full_name";
$customers_result = mysqli_query($conn, $customers_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = (int)$_POST['property_id'];
    $customer_id = (int)$_POST['customer_id'];
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = !empty($_POST['end_date']) ? "'" . mysqli_real_escape_string($conn, $_POST['end_date']) . "'" : 'NULL';
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

    $sql = "UPDATE Rentals SET property_id=$property_id, customer_id=$customer_id, start_date='$start_date', end_date=$end_date, payment_status='$payment_status' WHERE rental_id=$id";
    if (mysqli_query($conn, $sql)) {
        header('Location: list.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Rental</h2>
<form method="POST">
    <div class="mb-3">
        <label for="property_id" class="form-label">Property</label>
        <select class="form-control" id="property_id" name="property_id" required>
            <option value="">Select Property</option>
            <?php while ($property = mysqli_fetch_assoc($properties_result)): ?>
            <option value="<?php echo $property['property_id']; ?>" <?php if ($property['property_id'] == $rental['property_id']) echo 'selected'; ?>><?php echo htmlspecialchars($property['title']); ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="customer_id" class="form-label">Customer</label>
        <select class="form-control" id="customer_id" name="customer_id" required>
            <option value="">Select Customer</option>
            <?php while ($customer = mysqli_fetch_assoc($customers_result)): ?>
            <option value="<?php echo $customer['customer_id']; ?>" <?php if ($customer['customer_id'] == $rental['customer_id']) echo 'selected'; ?>><?php echo htmlspecialchars($customer['full_name']); ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $rental['start_date']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date (optional)</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $rental['end_date']; ?>">
    </div>
    <div class="mb-3">
        <label for="payment_status" class="form-label">Payment Status</label>
        <select class="form-control" id="payment_status" name="payment_status" required>
            <option value="Pending" <?php if ($rental['payment_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Paid" <?php if ($rental['payment_status'] == 'Paid') echo 'selected'; ?>>Paid</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../footer.php'; ?>