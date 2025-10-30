<?php
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Count total properties
$propCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM properties"))['total'];
$testCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM testimonials"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Prairie Hills</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Admin Dashboard</a>
    <div class="ms-auto">
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</nav>

<div class="container py-5">
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card shadow-sm p-3 text-center">
        <h4>Total Properties</h4>
        <p class="display-5 fw-bold"><?= $propCount ?></p>
        <a href="manage_properties.php" class="btn btn-primary">Manage Properties</a>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-sm p-3 text-center">
        <h4>Total Testimonials</h4>
        <p class="display-5 fw-bold"><?= $testCount ?></p>
        <a href="manage_testimonials.php" class="btn btn-primary">Manage Testimonials</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
