<?php
include("config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Track Order</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.step{
display:flex;
justify-content:space-between;
margin-top:30px;
}

.step div{
text-align:center;
width:25%;
}

.circle{
width:30px;
height:30px;
border-radius:50%;
background:#ccc;
margin:auto;
}

.active{
background:green;
color:white;
}
</style>

</head>

<body>

<div class="container mt-5">

<h2>Track Your Order</h2>

<form method="POST">
<input type="text" name="order_number" placeholder="Enter Order Number" class="form-control mb-3" required>

<button name="track" class="btn btn-primary">Track Order</button>
</form>

<?php

if(isset($_POST['track']))
{

$order_number = $_POST['order_number'];

$query = "SELECT * FROM orders WHERE order_number='$order_number'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)
{

$row = mysqli_fetch_assoc($result);

$status = $row['status'];

?>

<div class="card mt-4 p-4">

<h4>Order Details</h4>

<p><b>Order Number:</b> <?php echo $row['order_number']; ?></p>
<p><b>Name:</b> <?php echo $row['customer_name']; ?></p>
<p><b>Total Amount:</b> ₹ <?php echo $row['total_amount']; ?></p>

<div class="step">

<div>
<div class="circle <?php if($status=="Pending" || $status=="Processing" || $status=="Shipped" || $status=="Delivered") echo 'active'; ?>"></div>
<p>Pending</p>
</div>

<div>
<div class="circle <?php if($status=="Processing" || $status=="Shipped" || $status=="Delivered") echo 'active'; ?>"></div>
<p>Processing</p>
</div>

<div>
<div class="circle <?php if($status=="Shipped" || $status=="Delivered") echo 'active'; ?>"></div>
<p>Shipped</p>
</div>

<div>
<div class="circle <?php if($status=="Delivered") echo 'active'; ?>"></div>
<p>Delivered</p>
</div>

</div>

</div>

<?php
}
else
{
echo "<p class='text-danger mt-3'>Order Not Found</p>";
}

}
?>

</div>

</body>
</html>