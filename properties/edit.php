<?php
include '../auth/check_login.php';

$page_title = 'Edit Property';
include '../header.php';
include '../db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$sql = "SELECT * FROM Properties WHERE property_id = $id";
$result = mysqli_query($conn, $sql);
$property = mysqli_fetch_assoc($result);

if (!$property) {
    header('Location: list.php');
    exit;
}

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

    $sql = "UPDATE Properties SET landlord_id=$landlord_id, title='$title', description='$description', location='$location', price=$price, status='$status' WHERE property_id=$id";
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
            <h2 class="mb-4 text-center">Edit Property</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger px-4 rounded-pill"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="landlord_id" class="form-label">Landlord</label>
                    <select class="form-control rounded-pill px-4" id="landlord_id" name="landlord_id" required>
                        <?php while ($landlord = mysqli_fetch_assoc($landlords_result)): ?>
                        <option value="<?php echo $landlord['landlord_id']; ?>" <?php if ($landlord['landlord_id'] == $property['landlord_id']) echo 'selected'; ?>><?php echo htmlspecialchars($landlord['full_name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Property Title</label>
                    <input type="text" class="form-control rounded-pill px-4" id="title" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control rounded-4 px-4" id="description" name="description" rows="3"><?php echo htmlspecialchars($property['description']); ?></textarea>
                </div>
                <div class="row gx-2">
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control rounded-pill px-4" id="location" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price (Monthly)</label>
                        <input type="number" step="0.01" class="form-control rounded-pill px-4" id="price" name="price" value="<?php echo $property['price']; ?>" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="status" class="form-label">Availability Status</label>
                    <select class="form-control rounded-pill px-4" id="status" name="status" required>
                        <option value="Available" <?php if ($property['status'] == 'Available') echo 'selected'; ?>>Available</option>
                        <option value="Rented" <?php if ($property['status'] == 'Rented') echo 'selected'; ?>>Rented</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 flex-grow-1">Update Property</button>
                    <a href="list.php" class="btn btn-secondary rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>