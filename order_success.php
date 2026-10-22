<?php
include("config/db.php");

if(!isset($_GET['order'])){
    header("Location: products.php");
    exit;
}

$order_number = mysqli_real_escape_string($conn, $_GET['order']);

$result = mysqli_query($conn, 
    "SELECT * FROM orders WHERE order_number='$order_number'");

if(mysqli_num_rows($result) == 0){
    echo "Order Not Found!";
    exit;
}

$order = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Success</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<div class="card shadow p-5 text-center">

<h2 class="text-success mb-4">✅ Order Placed Successfully!</h2>
<p><strong>Order Number:</strong> <?php echo $order['order_number']; ?></p>
<p><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
<p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
<p><strong>Total Paid:</strong> ₹ <?php echo $order['total_amount']; ?></p>
<p><strong>Email Id:</strong>  <?php echo  $order['email_id'] ?? 'not Available';?></p>
<p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>


<div class="mt-4">

    <a href="invoice.php?order=<?php echo $order['order_number']; ?>" 
       class="btn btn-dark">
       Download Invoice PDF
    </a>

    <a href="products.php" class="btn btn-primary">
       Continue Shopping
    </a>

</div>

</div>

</body>
</html>