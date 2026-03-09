<?php
$page_title = 'Rentals';
include '../header.php';
include '../db_connect.php';

// Fetch all rentals with property and customer names
$sql = "SELECT r.*, p.title AS property_title, c.full_name AS customer_name FROM Rentals r JOIN Properties p ON r.property_id = p.property_id JOIN Customers c ON r.customer_id = c.customer_id ORDER BY r.rental_id DESC";
$result = mysqli_query($conn, $sql);
?>

<h2>Rentals</h2>
<a href="create.php" class="btn btn-primary">Add New Rental</a>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Property</th>
            <th>Customer</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Payment Status</th>
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
            <td><?php echo $row['end_date'] ?? 'Ongoing'; ?></td>
            <td><?php echo $row['payment_status']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['rental_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?php echo $row['rental_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../footer.php'; ?>