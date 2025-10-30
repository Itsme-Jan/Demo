<?php
include 'config.php';

// Fetch services (static)
$services = [
    ['icon'=>'bi-house-door','title'=>'Buy a Home','desc'=>'Find your dream home in Dubai and other Emirates.'],
    ['icon'=>'bi-key','title'=>'Rent a Home','desc'=>'Affordable rental properties for your lifestyle.'],
    ['icon'=>'bi-cash-stack','title'=>'Sell a Property','desc'=>'Quickly sell your property with best prices.'],
    ['icon'=>'bi-building','title'=>'Living Spaces','desc'=>'Comfortable living spaces designed for you.']
];

// Fetch offers (static)
$offers = [
    ['title'=>'Low EMI Options','desc'=>'Flexible payment plans for all buyers.'],
    ['title'=>'Discounts','desc'=>'Seasonal discounts and special offers on properties.'],
    ['title'=>'Property Management','desc'=>'We take care of your property while you relax.']
];

// Fetch testimonials
$testimonials = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prairies Hills Real Estate</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<style>
    .banner {
    background: url('assets/images/banner.jpg') no-repeat center center;
    background-size: cover;
    height: 70vh;
    position: relative;
    color: #fff;
}
</style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Banner -->
<section class="banner d-flex align-items-center justify-content-center text-center">
    <div class="overlay"></div>
    <div class="content text-white">
        <h1 class="display-4 fw-bold">Prairies Hills</h1>
        <p class="lead mb-4">Discover the finest properties in Dubai and across UAE</p>
        <a href="properties.php" class="btn btn-primary btn-lg">Explore Properties</a>
    </div>
</section>

<!-- Services -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center">Our Services</h2>
        <div class="row text-center">
            <?php foreach($services as $s){ ?>
            <div class="col-md-3 mb-4">
                <i class="bi <?= $s['icon'] ?> service-icon mb-3"></i>
                <h5><?= $s['title'] ?></h5>
                <p><?= $s['desc'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Offers -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center">Why Choose Us</h2>
        <div class="row text-center">
            <?php foreach($offers as $o){ ?>
            <div class="col-md-4 mb-4">
                <h5><?= $o['title'] ?></h5>
                <p><?= $o['desc'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Vision -->
<section class="py-5 text-center">
    <div class="container">
        <h2>You are in the right place</h2>
        <p>At Prairie Hills, we are redefining the real estate experience with innovation, transparency, and trust. Our mission is to make property buying, selling, and renting seamless and enjoyable.</p>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center">Testimonials</h2>

    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="false" data-bs-wrap="true">
      <div class="carousel-inner">
        <?php
        $testimonialsData = [];
        while ($row = mysqli_fetch_assoc($testimonials)) {
            $testimonialsData[] = $row;
        }
        $total = count($testimonialsData);
        if ($total > 0) {
            $chunks = array_chunk($testimonialsData, 3);
            $active = true;
            foreach ($chunks as $group) {
        ?>
          <div class="carousel-item <?= $active ? 'active' : '' ?>">
            <div class="row justify-content-center">
              <?php foreach ($group as $t) { ?>
                <div class="col-md-4 mb-4 text-center">
                  <img src="assets/images/<?= htmlspecialchars($t['image']) ?>"
                       class="testimonial-img mb-3"
                       alt="<?= htmlspecialchars($t['name']) ?>">
                  <h5 class="fw-semibold mb-1"><?= htmlspecialchars($t['name']) ?></h5>
                  <p class="text-muted fst-italic px-3">“<?= htmlspecialchars($t['message']) ?>”</p>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php
            $active = false;
            }
        } else {
            echo '<p class="text-center text-muted">No testimonials available.</p>';
        }
        ?>
      </div>

      <?php if ($total > 3) { ?>
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <?php } ?>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
