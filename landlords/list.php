<?php
include '../auth/check_login.php';

$page_title = 'Manage Landlords';
include '../header.php';
include '../db_connect.php';

// Fetch all landlords
$sql = "SELECT landlord_id, full_name, phone, email, created_at FROM Landlords ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="card p-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Landlords</h2>
        <a href="create.php" class="btn btn-primary rounded-pill px-4">Add New Landlord</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
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
                    <td><?php echo $row['landlord_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['landlord_id']; ?>" class="btn btn-sm btn-warning rounded-pill px-3">Edit</a>
                        <a href="delete.php?id=<?php echo $row['landlord_id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../footer.php'; ?>
