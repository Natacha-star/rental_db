<?php
include '../auth/check_login.php';

$page_title = 'Rentals';
include '../header.php';
include '../db_connect.php';

// Fetch all rentals with property and customer details
$sql = "SELECT r.*, p.title AS property_title, c.full_name AS customer_name 
        FROM Rentals r 
        JOIN Properties p ON r.property_id = p.property_id 
        JOIN Customers c ON r.customer_id = c.customer_id 
        ORDER BY r.start_date DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="card p-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Rentals Management</h2>
        <a href="create.php" class="btn btn-primary rounded-pill px-4">Add New Rental</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Property</th>
                    <th>Customer</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['rental_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['property_title']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date'] ?: 'N/A'; ?></td>
                    <td>
                        <span class="badge rounded-pill <?php echo ($row['payment_status'] === 'Paid') ? 'bg-success' : 'bg-warning text-dark'; ?>">
                            <?php echo $row['payment_status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['rental_id']; ?>" class="btn btn-sm btn-warning rounded-pill px-3">Edit</a>
                        <a href="delete.php?id=<?php echo $row['rental_id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../footer.php'; ?>