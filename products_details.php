<?php
include 'config/db.php';
include 'includes/header.php';

// Check id aaya hai ya nahi
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='container mt-5'><h4>Invalid Product ID</h4></div>";
    include 'includes/footer.php';
    exit();
}

$id = intval($_GET['id']); // security ke liye intval

// Query
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);

// 🔥 Quick Test (IMPORTANT)
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

// Agar product nahi mila
if (mysqli_num_rows($result) == 0) {
    echo "<div class='container mt-5'><h4>Product not found</h4></div>";
    include 'includes/footer.php';
    exit();
}

$product = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">
                <?php echo htmlspecialchars($product['name']); ?>
            </h2>

            <h4 class="text-success">
                ₹ <?php echo htmlspecialchars($product['price']); ?>
            </h4>

            <p class="card-text mt-3">
                <?php echo htmlspecialchars($product['description']); ?>
            </p>

            <a href="products.php" class="btn btn-secondary mt-3">
                Back to Products
            </a>
        </div>
    </div>
</div>