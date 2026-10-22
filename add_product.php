<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit;
}

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, "../uploads/".$image);

    mysqli_query($conn, "INSERT INTO products (name, price, image) 
                         VALUES ('$name', '$price', '$image')");

    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Add Product</h2>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Product Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>

    <button name="add" class="btn btn-primary">Add Product</button>
</form>

</body>
</html>