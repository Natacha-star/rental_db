<?php
$page_title = 'Edit Property';
include '../header.php';
include '../db_connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Properties WHERE property_id = $id";
$result = mysqli_query($conn, $sql);
$property = mysqli_fetch_assoc($result);

// Fetch landlords
$landlords_sql = "SELECT landlord_id, full_name FROM Landlords ORDER BY full_name";
$landlords_result = mysqli_query($conn, $landlords_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $landlord_id = (int)$_POST['landlord_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $price = (float)$_POST['price'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE Properties SET landlord_id=$landlord_id, title='$title', description='$description', location='$location', price=$price, status='$status' WHERE property_id=$id";
    if (mysqli_query($conn, $sql)) {
        header('Location: list.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Property</h2>
<form method="POST">
    <div class="mb-3">
        <label for="landlord_id" class="form-label">Landlord</label>
        <select class="form-control" id="landlord_id" name="landlord_id" required>
            <option value="">Select Landlord</option>
            <?php while ($landlord = mysqli_fetch_assoc($landlords_result)): ?>
            <option value="<?php echo $landlord['landlord_id']; ?>" <?php if ($landlord['landlord_id'] == $property['landlord_id']) echo 'selected'; ?>><?php echo htmlspecialchars($landlord['full_name']); ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($property['description']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $property['price']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Available" <?php if ($property['status'] == 'Available') echo 'selected'; ?>>Available</option>
            <option value="Rented" <?php if ($property['status'] == 'Rented') echo 'selected'; ?>>Rented</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../footer.php'; ?>