<?php
$page_title = 'Add Customer';
include '../header.php';
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO Customers (full_name, phone, email) VALUES ('$full_name', '$phone', '$email')";
    if (mysqli_query($conn, $sql)) {
        header('Location: list.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Add New Customer</h2>
<form method="POST">
    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" name="full_name" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../footer.php'; ?>