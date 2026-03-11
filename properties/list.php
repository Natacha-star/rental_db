<?php
include '../auth/check_login.php';
$page_title = 'Properties';
include '../header.php';
include '../db_connect.php';

// Fetch all properties with landlord name
$sql = "SELECT p.*, l.full_name AS landlord_name FROM Properties p JOIN Landlords l ON p.landlord_id = l.landlord_id ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="card p-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Properties</h2>
        <a href="create.php" class="btn btn-primary rounded-pill px-4">Add New Property</a>
    </div>
    
    <div class="mb-4">
        <form class="d-flex" method="GET">
            <input class="form-control rounded-pill px-4 me-2" type="search" name="search" placeholder="Search by location or title..." aria-label="Search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            <button class="btn btn-outline-primary rounded-pill px-4" type="submit">Search</button>
        </form>
    </div>

    <?php
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $sql = "SELECT p.*, l.full_name AS landlord_name FROM Properties p JOIN Landlords l ON p.landlord_id = l.landlord_id 
                WHERE p.title LIKE '%$search%' OR p.location LIKE '%$search%'
                ORDER BY p.created_at DESC";
        $result = mysqli_query($conn, $sql);
    }
    ?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
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
                    <td><strong><?php echo htmlspecialchars($row['title']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo number_format($row['price'], 0); ?> RWF</td>
                    <td>
                        <span class="badge rounded-pill <?php echo ($row['status'] === 'Available') ? 'bg-success' : 'bg-secondary'; ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($row['landlord_name']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['property_id']; ?>" class="btn btn-sm btn-warning rounded-pill px-3">Edit</a>
                        <a href="delete.php?id=<?php echo $row['property_id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../footer.php'; ?>