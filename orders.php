<?php
session_start();
include("config/db.php");
include("includes/header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id=$user_id ORDER BY id DESC");
?>

<div class="container mt-5">
<h2>📦 My Orders</h2>

<?php while($order = mysqli_fetch_assoc($result)): ?>

<div class="card mb-3 p-3">
    <h5>Order ID: <?= $order['id'] ?></h5>
    <p>Total: ₹<?= $order['total'] ?></p>
    <p>Date: <?= $order['created_at'] ?></p>

    <strong>Items:</strong>
    <ul>
    <?php
    $order_id = $order['id'];
    $items = mysqli_query($conn, "
        SELECT order_items.*, products.name 
        FROM order_items 
        JOIN products ON order_items.product_id = products.id
        WHERE order_items.order_id=$order_id
    ");

    while($item = mysqli_fetch_assoc($items)):
    ?>
        <li>
            <?= $item['name'] ?> 
            (Qty: <?= $item['quantity'] ?>) 
            - ₹<?= $item['price'] ?>
        </li>
    <?php endwhile; ?>
    </ul>
</div>

<?php endwhile; ?>

</div>

<?php include("includes/footer.php"); ?>