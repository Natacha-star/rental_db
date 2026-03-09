<?php
$page_title = 'Add Property';
include '../header.php';
include '../db_connect.php';

// Fetch landlords for dropdown
$landlords_sql = "SELECT landlord_id, full_name FROM Landlords ORDER BY full_name";
$landlords_result = mysqli_query($conn, $landlords_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $landlord_id = (int)$_POST['landlord_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $price = (float)$_POST['price'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO Properties (landlord_id, title, description, location, price, status) VALUES ($landlord_id, '$title', '$description', '$location', $price, '$status')";
    if (mysqli_query($conn, $sql)) {
        header('Location: list.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Add New Property</h2>
<form method="POST">
    <div class="mb-3">
        <label for="landlord_id" class="form-label">Landlord</label>
        <select class="form-control" id="landlord_id" name="landlord_id" required>
            <option value="">Select Landlord</option>
            <?php while ($landlord = mysqli_fetch_assoc($landlords_result)): ?>
            <option value="<?php echo $landlord['landlord_id']; ?>"><?php echo htmlspecialchars($landlord['full_name']); ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Available">Available</option>
            <option value="Rented">Rented</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../footer.php'; ?>