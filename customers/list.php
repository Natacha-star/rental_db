<?php
$page_title = 'Customers';
include '../header.php';
include '../db_connect.php';

// Fetch all customers
$sql = "SELECT * FROM Customers ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<h2>Customers</h2>
<a href="create.php" class="btn btn-primary">Add New Customer</a>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['customer_id']; ?></td>
            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../footer.php'; ?>