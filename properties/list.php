<?php
$page_title = 'Properties';
include '../header.php';
include '../db_connect.php';

// Fetch all properties with landlord name
$sql = "SELECT p.*, l.full_name AS landlord_name FROM Properties p JOIN Landlords l ON p.landlord_id = l.landlord_id ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<h2>Properties</h2>
<a href="create.php" class="btn btn-primary">Add New Property</a>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Location</th>
            <th>Price</th>
            <th>Status</th>
            <th>Landlord</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['property_id']; ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars(substr($row['description'], 0, 50)); ?>...</td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo number_format($row['price'], 2); ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo htmlspecialchars($row['landlord_name']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['property_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?php echo $row['property_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../footer.php'; ?>