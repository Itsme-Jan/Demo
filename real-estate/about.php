<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - Prairie Hills</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Banner -->
<section class="about-banner text-center position-relative d-flex align-items-center justify-content-center">
    <div class="overlay position-absolute w-100 h-100"></div>
    <div class="content position-relative text-white">
        <h1 class="display-4 fw-bold">About Prairie Hills</h1>
        <p class="lead mb-4">Redefining Real Estate Experiences Across UAE</p>
    </div>
</section>

<!-- Company Story -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Story</h2>
        <p class="text-center lead">Prairie Hills Real Estate was founded with a vision to provide transparent, trustworthy, and innovative real estate solutions. We connect people with their dream properties and redefine the way buying, selling, and renting works across UAE.</p>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 mb-4">
                <i class="bi bi-lightbulb fs-1 mb-3 text-primary"></i>
                <h4>Our Mission</h4>
                <p>To make property transactions seamless, efficient, and satisfying for everyone involved.</p>
            </div>
            <div class="col-md-6 mb-4">
                <i class="bi bi-eye fs-1 mb-3 text-primary"></i>
                <h4>Our Vision</h4>
                <p>To be the most trusted real estate company in UAE, known for integrity, excellence, and customer satisfaction.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Meet Our Team</h2>
        <div class="row justify-content-center g-4">
            <div class="col-md-3 text-center">
                <div class="card border-0 shadow-sm p-3">
                    <img src="assets/images/pic-1.png" class="img-fluid rounded mb-3" alt="CEO">
                    <h6>Test 1</h6>
                    <p>CEO & Founder</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card border-0 shadow-sm p-3">
                    <img src="assets/images/pic-2.png" class="img-fluid rounded mb-3" alt="Manager">
                    <h6>Test 2</h6>
                    <p>Operations Manager</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card border-0 shadow-sm p-3">
                    <img src="assets/images/pic-5.png" class="img-fluid rounded mb-3" alt="Agent">
                    <h6>Test 3</h6>
                    <p>Lead Agent</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
