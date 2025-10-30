<?php
$whatsappNumber = "1234567890"; // Your WhatsApp number
$preFilledMessage = urlencode("Hello Prairie Hills, I would like to get in touch.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Prairie Hills</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Banner -->
<section class="contact-banner">
    <h1>Contact Prairie Hills</h1>
    <p>We’d love to hear from you! Reach out via WhatsApp, email, or visit us directly.</p>
</section>

<!-- Info Cards -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="bi bi-geo-alt-fill"></i>
                    <h5>Location</h5>
                    <p>123 Prairie Hills, Dubai, UAE</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="bi bi-envelope-fill"></i>
                    <h5>Email</h5>
                    <p>info@prairiehills.com</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="bi bi-telephone-fill"></i>
                    <h5>Phone & WhatsApp</h5>
                    <p>+971 50 123 4567</p>
                    <a href="https://wa.me/<?= $whatsappNumber ?>?text=<?= $preFilledMessage ?>" target="_blank" class="btn whatsapp-btn mt-2 text-white">
                        <i class="bi bi-whatsapp"></i> Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form + Map -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-4">Send a Message</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="name" placeholder="Your Name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Your Email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" rows="5" placeholder="Your Message" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn submit-btn w-100 text-white">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps?q=Dubai,+UAE&output=embed" width="100%" height="100%"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
