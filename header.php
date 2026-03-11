<?php
// Session started just in case other scripts depend on it, 
// but we remove role-based logic.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_path = $_SERVER['PHP_SELF'];
$dir_parts = explode('/', str_replace('\\', '/', $current_path));
$in_subfolder = false;
foreach(['customers', 'properties', 'rentals', 'landlords'] as $folder) {
    if (in_array($folder, $dir_parts)) {
        $in_subfolder = true;
        break;
    }
}

$path_prefix = $in_subfolder ? '../' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Rental Management'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo $path_prefix; ?>assets/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $path_prefix; ?>index.php">Rental System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_prefix; ?>index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_prefix; ?>properties/list.php">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_prefix; ?>customers/list.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_prefix; ?>rentals/list.php">Rentals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_prefix; ?>landlords/list.php">Landlords</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">