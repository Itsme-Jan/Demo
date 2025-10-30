<?php
include '../config.php';
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    // delete image file
    $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM properties WHERE id=$id"))['image'];
    if(file_exists("../assets/images/".$img)){
        unlink("../assets/images/".$img);
    }
    mysqli_query($conn, "DELETE FROM properties WHERE id=$id");
    header("Location: manage_properties.php");
    exit;
}

$properties = mysqli_query($conn, "SELECT * FROM properties ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Properties - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Manage Properties</h2>
  <a href="add_property.php" class="btn btn-success mb-3">Add New Property</a>
  <a href="dashboard.php" class="btn btn-secondary mb-3">Dashboard</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Type</th>
        <th>Category</th>
        <th>Emirate</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($prop = mysqli_fetch_assoc($properties)) { ?>
        <tr>
          <td><?= $prop['id'] ?></td>
          <td><?= $prop['title'] ?></td>
          <td><?= $prop['type'] ?></td>
          <td><?= $prop['category'] ?></td>
          <td><?= $prop['emirate'] ?></td>
          <td><?= $prop['price'] ?></td>
          <td><img src="../assets/images/<?= $prop['image'] ?>" width="80" alt="<?= $prop['title'] ?>"></td>
          <td>
            <a href="edit_property.php?id=<?= $prop['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
            <a href="?delete=<?= $prop['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
