<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental System Java - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<%= request.getContextPath() %>/index.jsp">RentalSystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<%= request.getContextPath() %>/index.jsp">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<%= request.getContextPath() %>/customers?action=list">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<%= request.getContextPath() %>/landlords?action=list">Landlords</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<%= request.getContextPath() %>/properties?action=list">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<%= request.getContextPath() %>/rentals?action=list">Rentals</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center py-5 shadow-sm bg-white rounded">
        <h1 class="display-4 fw-bold text-primary">Welcome to Rental Management System</h1>
        <p class="lead mt-3 text-muted">A simple Java CRUD web application built with Servlets and JSP.</p>
        <hr class="my-4">
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="card border-0 bg-light p-4 h-100">
                    <h5 class="fw-bold">Customers</h5>
                    <p class="small text-secondary">Manage rental customers</p>
                    <a href="<%= request.getContextPath() %>/customers?action=list" class="btn btn-primary mt-auto">Manage</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-4 h-100">
                    <h5 class="fw-bold">Landlords</h5>
                    <p class="small text-secondary">Manage property owners</p>
                    <a href="<%= request.getContextPath() %>/landlords?action=list" class="btn btn-primary mt-auto">Manage</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-4 h-100">
                    <h5 class="fw-bold">Properties</h5>
                    <p class="small text-secondary">Manage listing properties</p>
                    <a href="<%= request.getContextPath() %>/properties?action=list" class="btn btn-primary mt-auto">Manage</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-4 h-100">
                    <h5 class="fw-bold">Rentals</h5>
                    <p class="small text-secondary">Manage active rentals</p>
                    <a href="<%= request.getContextPath() %>/rentals?action=list" class="btn btn-primary mt-auto">Manage</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
