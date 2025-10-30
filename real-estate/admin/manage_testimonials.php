<?php
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Handle delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM testimonials WHERE id=$id");
    header("Location: manage_testimonials.php?deleted=1");
    exit;
}

$error = '';
$success = '';

// Handle add testimonial
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $message = $_POST['message'];

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $imgName = time().'_'.basename($_FILES['image']['name']);
        $targetPath = "../assets/images/".$imgName;

        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $sql = "INSERT INTO testimonials (name, message, image) VALUES ('$name','$message','$imgName')";
            if(mysqli_query($conn, $sql)){
                header("Location: manage_testimonials.php?success=1");
                exit;
            } else {
                $error = "Database Error: ".mysqli_error($conn);
            }
        } else {
            $error = "Failed to upload image. Please try again.";
        }
    } else {
        $error = "Please upload an image.";
    }
}

// Handle success or delete messages
if(isset($_GET['success'])) {
    $success = "✅ Testimonial added successfully!";
}
if(isset($_GET['deleted'])) {
    $success = "🗑️ Testimonial deleted successfully!";
}

// Fetch testimonials (this happens *after* insert/delete actions)
$testimonials = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Testimonials - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Manage Testimonials</h2>

  <?php if($error != ''): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <?php if($success != ''): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="mb-4">
    <div class="row g-3">
      <div class="col-md-4">
        <input type="text" name="name" class="form-control" placeholder="Client Name" required>
      </div>
      <div class="col-md-4">
        <input type="file" name="image" class="form-control" required>
      </div>
      <div class="col-md-4">
        <input type="text" name="message" class="form-control" placeholder="Message" required>
      </div>
    </div>
    <button type="submit" name="submit" class="btn btn-success mt-3">Add Testimonial</button>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Dashboard</a>
  </form>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Message</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
  </thead>
    <tbody>
      <?php while($t = mysqli_fetch_assoc($testimonials)): ?>
        <tr>
          <td><?= $t['id'] ?></td>
          <td><?= htmlspecialchars($t['name']) ?></td>
          <td><?= htmlspecialchars($t['message']) ?></td>
          <td><img src="../assets/images/<?= htmlspecialchars($t['image']) ?>" width="80" class="rounded"></td>
          <td>
            <a href="?delete=<?= $t['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this testimonial?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
