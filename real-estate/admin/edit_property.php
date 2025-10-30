<?php
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])) {
    header("Location: manage_properties.php");
    exit;
}

$id = intval($_GET['id']);
$property = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM properties WHERE id=$id"));

$error = '';
$success = '';

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $emirate = $_POST['emirate'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $imgName = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/".$imgName);

        // Delete old image
        if(file_exists("../assets/images/".$property['image'])) {
            unlink("../assets/images/".$property['image']);
        }
    } else {
        $imgName = $property['image'];
    }

    $sql = "UPDATE properties SET title='$title', type='$type', category='$category', emirate='$emirate', price='$price', description='$description', image='$imgName' WHERE id=$id";

    if(mysqli_query($conn, $sql)) {
        $success = "Property updated successfully!";
        $property = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM properties WHERE id=$id"));
    } else {
        $error = "Error: ".mysqli_error($conn);
    }
}

$emirates = ['Abu Dhabi','Dubai','Sharjah','Ajman','Ras Al Khaimah','Fujairah','Umm Al Quwain'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Property - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Edit Property</h2>
  <?php if($error != '') echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
  <?php if($success != '') echo '<div class="alert alert-success">'.$success.'</div>'; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="<?= $property['title'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Type</label>
      <select name="type" class="form-select" required>
        <option value="Studio" <?= $property['type']=='Studio'?'selected':'' ?>>Studio</option>
        <option value="1 BHK" <?= $property['type']=='1 BHK'?'selected':'' ?>>1 BHK</option>
        <option value="2 BHK" <?= $property['type']=='2 BHK'?'selected':'' ?>>2 BHK</option>
        <option value="3 BHK" <?= $property['type']=='3 BHK'?'selected':'' ?>>3 BHK</option>
        <option value="Penthouse" <?= $property['type']=='Penthouse'?'selected':'' ?>>Penthouse</option>
        </select>
    </div>
    <div class="mb-3">
      <label>Category</label>
      <select name="category" class="form-select" required>
        <option value="Rent" <?= $property['category']=='Rent'?'selected':'' ?>>Rent</option>
        <option value="Buy" <?= $property['category']=='Buy'?'selected':'' ?>>Buy</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Emirate</label>
      <select name="emirate" class="form-select" required>
        <?php foreach($emirates as $e) echo '<option value="'.$e.'" '.($property['emirate']==$e?'selected':'').'>'.$e.'</option>'; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="text" name="price" class="form-control" value="<?= $property['price'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control" rows="4"><?= $property['description'] ?></textarea>
    </div>
    <div class="mb-3">
      <label>Current Image</label><br>
      <img src="../assets/images/<?= $property['image'] ?>" width="150" class="mb-2">
      <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-success">Update Property</button>
    <a href="manage_properties.php" class="btn btn-secondary">Back</a>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
