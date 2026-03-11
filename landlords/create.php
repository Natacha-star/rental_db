include '../auth/check_login.php';

$page_title = 'Add Landlord';
include '../header.php';
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Landlords (full_name, phone, email, password) VALUES ('$full_name', '$phone', '$email', '$password')";
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
            <h2 class="mb-4 text-center">Add New Landlord</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control rounded-pill px-4" id="full_name" name="full_name" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control rounded-pill px-4" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control rounded-pill px-4" id="email" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control rounded-pill px-4" id="password" name="password" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 flex-grow-1">Save Landlord</button>
                    <a href="list.php" class="btn btn-secondary rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>
