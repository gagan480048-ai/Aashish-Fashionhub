<?php
session_start();
include("../config/db.php");

$result = mysqli_query($conn,"SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin - Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h2>All Orders</h2>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Order Number</th>
<th>Name</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['order_number']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td>₹ <?php echo $row['total_amount']; ?></td>

<td><?php echo $row['payment_method']; ?></td>

<td>

<form method="POST" action="update_status.php">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="status" class="form-control">

<option>Pending</option>
<option>Processing</option>
<option>Shipped</option>
<option>Delivered</option>

</select>

<button name="update" class="btn btn-success btn-sm mt-1">Update</button>

</form>

</td>

<td>

<a href="delete_order.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
Delete
</a>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>