<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit;
}

$product_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
$order_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
$user_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>📊 Admin Dashboard</h2>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card p-4 text-center bg-primary text-white">
            <h4>Total Products</h4>
            <h2><?php echo $product_count; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center bg-success text-white">
            <h4>Total Orders</h4>
            <h2><?php echo $order_count; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center bg-warning text-dark">
            <h4>Total Users</h4>
            <h2><?php echo $user_count; ?></h2>
        </div>
    </div>
</div>

<br>
<a href="products.php" class="btn btn-dark">Manage Products</a>

</body>
</html>