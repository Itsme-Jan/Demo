<?php
include 'config.php';

if(!isset($_GET['id'])) {
    header("Location: properties.php");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM properties WHERE id=$id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    die("Property not found.");
}

$property = mysqli_fetch_assoc($result);
$whatsappNumber = "1234567890"; // Your WhatsApp number
$preFilledMessage = urlencode("Hello, I am interested in the property: ".$property['title']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $property['title'] ?> - Prairie Hills</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
  .hero-img {
    background: url('assets/images/<?= $property['image'] ?>') no-repeat center center;
    background-size: cover;
    height: 55vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-shadow: 2px 2px 12px rgba(0,0,0,0.7);
}
</style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Hero Image -->
<section class="hero-img">
    <h1><?= $property['title'] ?></h1>
</section>

<!-- Property Details -->
<div class="container py-5">
  <div class="row g-4">
    <div class="col-lg-6">
      <img src="assets/images/<?= $property['image'] ?>" class="img-fluid rounded shadow-sm" alt="<?= $property['title'] ?>">
    </div>
    <div class="col-lg-6">
      <div class="details-card">
        <h3><?= $property['title'] ?> | <?= $property['type'] ?> </h3>
        <p class="mb-3">
          <span class="badge badge-category text-white me-2"><?= $property['category'] ?></span>
          <span class="badge badge-emirate text-white"><?= $property['emirate'] ?></span>
        </p>
        <h4 class="mt-3"><?= $property['price'] ?></h4>
        <p class="mt-3"><?= nl2br($property['description']) ?></p>
        <div class="mt-4 d-flex flex-column flex-md-row align-items-start gap-2">
            <a href="properties.php" class="btn btn-secondary me-md-2 mb-2 mb-md-0">
                <i class="bi bi-arrow-left"></i> Back to Properties
            </a>
            <a href="https://wa.me/<?= $whatsappNumber ?>?text=<?= $preFilledMessage ?>" target="_blank" class="btn whatsapp-btn text-white">
                <i class="bi bi-whatsapp"></i> Contact via WhatsApp
            </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
