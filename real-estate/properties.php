<?php
include 'config.php';

// Initialize filter variables
$category = isset($_GET['category']) ? $_GET['category'] : '';
$emirate = isset($_GET['emirate']) ? $_GET['emirate'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Build query safely
$sql = "SELECT * FROM properties WHERE 1=1";

// If category is "All", show everything (ignore other filters)
if (strtolower($category) == 'all') {
    // Do nothing — no filters applied
} else {
    if ($category != '') {
        $category = mysqli_real_escape_string($conn, $category);
        $sql .= " AND category='$category'";
    }

    if ($type != '') {
        $type = mysqli_real_escape_string($conn, $type);
        $sql .= " AND type='$type'";
    }

    if ($emirate != '') {
        $emirate = mysqli_real_escape_string($conn, $emirate);
        $sql .= " AND emirate='$emirate'";
    }
}

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$emirates = ['Abu Dhabi','Dubai','Sharjah','Ajman','Ras Al Khaimah','Fujairah','Umm Al Quwain'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Properties - Prairie Hills</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
    <h2>Properties for Rent & Buy</h2>

    <!-- Filters -->
    <form method="GET" class="row g-3 mb-5 filter-form justify-content-center">
        <div class="col-md-3">
            <select class="form-select" name="category">
                <option value="">Select Category</option>
                <option value="All" <?= strtolower($category)=='all'?'selected':'' ?>>All</option>
                <option value="Rent" <?= $category =='Rent'?'selected':'' ?>>Rent</option>
                <option value="Buy" <?= $category =='Buy'?'selected':'' ?>>Buy</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="emirate">
                <option value="">Select Emirate</option>
                <?php foreach($emirates as $e){ ?>
                    <option value="<?= $e ?>" <?= $emirate==$e?'selected':'' ?>><?= $e ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="type">
                <option value="">Select Type</option>
                <option value="Studio" <?= $type =='Studio'?'selected':'' ?>>Studio</option>
                <option value="1 BHK" <?= $type =='1 BHK'?'selected':'' ?>>1 BHK</option>
                <option value="2 BHK" <?= $type =='2 BHK'?'selected':'' ?>>2 BHK</option>
                <option value="3 BHK" <?= $type =='3 BHK'?'selected':'' ?>>3 BHK</option>
                <option value="Penthouse" <?= $type =='Penthouse'?'selected':'' ?>>Penthouse</option>
            </select>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-5">Filter</button>
        </div>
    </form>

    <!-- Properties List -->
    <div class="row g-4">
        <?php if(mysqli_num_rows($result) > 0) { 
            while($property = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4">
                    <div class="card property-card shadow-sm h-100">
                        <img src="assets/images/<?= $property['image'] ?>" class="card-img-top property-img" alt="<?= $property['title'] ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $property['title'] ?> | <?= $property['type'] ?></h5>
                            <p class="card-text"><?= $property['emirate'] ?> | <?= $property['category'] ?></p>
                            <p class="card-text fw-bold"><?= $property['price'] ?></p>
                            <a href="property-details.php?id=<?= $property['id'] ?>" class="btn btn-primary mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
        <?php } 
        } else { ?>
            <div class="col-12">
                <p class="text-center fs-5">No properties found for the selected filters.</p>
            </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
