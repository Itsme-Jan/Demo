<?php
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $emirate = $_POST['emirate'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $imgName = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/".$imgName);

        $sql = "INSERT INTO properties (title, type, category, emirate, price, description, image) 
                VALUES ('$title','$type','$category','$emirate','$price','$description','$imgName')";
        if(mysqli_query($conn, $sql)){
            $success = "Property added successfully!";
        } else {
            $error = "Error: ".mysqli_error($conn);
        }
    } else {
        $error = "Please upload an image.";
    }
}

$emirates = ['Abu Dhabi','Dubai','Sharjah','Ajman','Ras Al Khaimah','Fujairah','Umm Al Quwain'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Property - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Add New Property</h2>
  <?php if($error != '') echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
  <?php if($success != '') echo '<div class="alert alert-success">'.$success.'</div>'; ?>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Type</label>
      <select name="type" class="form-select" required>
        <option value="">Select</option>
        <option value="Studio">Studio</option>
        <option value="1 BHK">1 BHK</option>
        <option value="2 BHK">2 BHK</option>
        <option value="3 BHK">3 BHK</option>
        <option value="Penthouse">Penthouse</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Category</label>
      <select name="category" class="form-select" required>
        <option value="">Select</option>
        <option value="Rent">Rent</option>
        <option value="Buy">Buy</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Emirate</label>
      <select name="emirate" class="form-select" required>
        <option value="">Select</option>
        <?php foreach($emirates as $e) echo '<option value="'.$e.'">'.$e.'</option>'; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="text" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
      <label>Image</label>
      <input type="file" name="image" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Add Property</button>
    <a href="manage_properties.php" class="btn btn-secondary">Back</a>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
