<?php
include '../auth/check_login.php';

$page_title = 'Edit Landlord';
include '../header.php';
include '../db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$sql = "SELECT * FROM Landlords WHERE landlord_id = $id";
$result = mysqli_query($conn, $sql);
$landlord = mysqli_fetch_assoc($result);

if (!$landlord) {
    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Update password only if provided
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE Landlords SET full_name='$full_name', phone='$phone', email='$email', password='$password' WHERE landlord_id=$id";
    } else {
        $sql = "UPDATE Landlords SET full_name='$full_name', phone='$phone', email='$email' WHERE landlord_id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: list.php');
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card p-4">
            <h2 class="mb-4 text-center">Edit Landlord</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control rounded-pill px-4" id="full_name" name="full_name" value="<?php echo htmlspecialchars($landlord['full_name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control rounded-pill px-4" id="phone" name="phone" value="<?php echo htmlspecialchars($landlord['phone']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control rounded-pill px-4" id="email" name="email" value="<?php echo htmlspecialchars($landlord['email']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                    <input type="password" class="form-control rounded-pill px-4" id="password" name="password">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 flex-grow-1">Update Landlord</button>
                    <a href="list.php" class="btn btn-secondary rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>
