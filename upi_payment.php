<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['pending_order'])){
    header("Location: products.php");
    exit;
}

$order = $_SESSION['pending_order'];

if(isset($_POST['confirm_payment'])){

    $order_number = "ORD".rand(10000,99999);

    mysqli_query($conn, "INSERT INTO orders 
        (order_number, customer_name, address, payment_method, total_amount) 
        VALUES 
        ('$order_number', '".$order['name']."', '".$order['address']."', 'UPI', '".$order['total']."')");

    unset($_SESSION['cart']);
    unset($_SESSION['pending_order']);

    echo "
    <script>
        setTimeout(function(){
            window.location.href='order_success.php?order=".$order_number."';
        }, 3000);
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>UPI Payment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5 text-center">

<div class="card p-5 shadow">

<h3>📱 Scan & Pay via UPI</h3>
<h4>Amount: ₹ <?php echo $order['total']; ?></h4>

<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=FakeUPIPayment"
     class="my-4">

<p>Scan this QR using any UPI app</p>

<form method="post" id="paymentForm">
    <button type="submit" name="confirm_payment" 
            class="btn btn-success">
        I Have Paid
    </button>
</form>

<!-- Loading Spinner -->
<div id="loading" class="mt-4" style="display:none;">
    <div class="spinner-border text-success"></div>
    <p class="mt-2">Verifying Payment...</p>
</div>

</div>

<script>
document.getElementById("paymentForm").addEventListener("submit", function(){
    document.getElementById("loading").style.display = "block";
});
</script>

</body>
</html>