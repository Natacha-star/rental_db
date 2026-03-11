<?php
include '../auth/check_login.php';

$page_title = 'Edit Rental';
include '../header.php';
include '../db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$sql = "SELECT * FROM Rentals WHERE rental_id = $id";
$result = mysqli_query($conn, $sql);
$rental = mysqli_fetch_assoc($result);

if (!$rental) {
    header('Location: list.php');
    exit;
}

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
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<div class="row justify-content-center mt-4">
    <div class="col-md-7">
        <div class="card p-4 shadow-sm border-0">
            <h2 class="mb-4 text-center">Edit Rental Record</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger px-4 rounded-pill"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="property_id" class="form-label">Property</label>
                    <select class="form-control rounded-pill px-4 bg-light" id="property_id" name="property_id" required>
                        <option value="">-- Select Property --</option>
                        <?php while ($property = mysqli_fetch_assoc($properties_result)): ?>
                        <option value="<?php echo $property['property_id']; ?>" <?php if ($property['property_id'] == $rental['property_id']) echo 'selected'; ?>><?php echo htmlspecialchars($property['title']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select class="form-control rounded-pill px-4 bg-light" id="customer_id" name="customer_id" required>
                        <option value="">-- Select Customer --</option>
                        <?php while ($customer = mysqli_fetch_assoc($customers_result)): ?>
                        <option value="<?php echo $customer['customer_id']; ?>" <?php if ($customer['customer_id'] == $rental['customer_id']) echo 'selected'; ?>><?php echo htmlspecialchars($customer['full_name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="row gx-2">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control rounded-pill px-4" id="start_date" name="start_date" value="<?php echo $rental['start_date']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date (optional)</label>
                        <input type="date" class="form-control rounded-pill px-4" id="end_date" name="end_date" value="<?php echo $rental['end_date']; ?>">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <select class="form-control rounded-pill px-4" id="payment_status" name="payment_status" required>
                        <option value="Pending" <?php if ($rental['payment_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Paid" <?php if ($rental['payment_status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 flex-grow-1">Update Rental</button>
                    <a href="list.php" class="btn btn-secondary rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>