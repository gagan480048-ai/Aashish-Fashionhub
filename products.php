
<?php
session_start();
include("../config/db.php");

// 🔐 Admin Protection
if(!isset($_SESSION['admin'])){
header("Location:index.php");
exit;
}

// 🗑 Delete Product
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: products.php");
    exit;
}

// 📦 Fetch Products
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">All Products</h2>

<a href="add_product.php" class="btn btn-primary mb-3">+ Add New Product</a>
<a href="logout.…
<?php



if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit;
}

// Delete Product
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    // Pehle image delete karo
    $imgQuery = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    $imgData = mysqli_fetch_assoc($imgQuery);
    unlink("../uploads/".$imgData['image']);

    mysqli_query($conn, "DELETE FROM products WHERE id=$id");

    header("Location: products.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Products</title>
    <link rel="stylesheet
     href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
