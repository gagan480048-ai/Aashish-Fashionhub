<?php
session_start();
include("config/db.php");

// If cart empty
if(empty($_SESSION['cart'])){
    echo "<h3>Your cart is empty!</h3>";
    exit;
}

// Calculate total
$total = 0;

foreach($_SESSION['cart'] as $id => $qty){
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $total += $row['price'] * $qty;
    }
}

// When form submitted
if(isset($_POST['place_order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);

    $order_number = "ORD".rand(10000,99999);

    mysqli_query($conn, "INSERT INTO orders 
        (order_number, customer_name, email_id, address, payment_method, total_amount) 
        VALUES 
        ('$order_number', '$name', 'email', '$address', '$payment', '$total')");

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to success page
    header("Location: order_success.php?order=".$order_number);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">💳 Checkout Page</h2>

<div class="card p-4 shadow">

<h4>Total Amount: ₹ <?php echo $total; ?></h4>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type ="text" name="phone" class="form-control" required>
    </div>
 
    <div class="mb-3">
        <label class="form-label">Payment Method</label>
        <select name="payment" class="form-control" required>
            <option value="">Select Payment</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="UPI">UPI</option>
            <option value="Card">Card</option>
        </select>
    </div>

    <button type="submit" name="place_order" class="btn btn-success">
        Place Order
    </button>

</form>

</div>

</body>
</html>