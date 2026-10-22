<?php
session_start();
include("config/db.php");

// Initialize cart
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// --------------------
// ADD ITEM (+)
// --------------------
if(isset($_GET['id']) && !isset($_GET['from_cart'])){

    $id = intval($_GET['id']);
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

    header("Location: cart.php?from_cart=1");
    exit;
}
// --------------------
// DECREASE ITEM (-)
// --------------------
if(isset($_GET['decrease'])){
    $id = intval($_GET['decrease']);

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]--;

        if($_SESSION['cart'][$id] <= 0){
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit;
}

// --------------------
// REMOVE ITEM
// --------------------
if(isset($_GET['remove'])){
    $id = intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);

    header("Location: cart.php");
    exit;
}

// --------------------
// CLEAR CART
// --------------------
if(isset($_GET['clear'])){
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">🛒 Your Cart</h2>

<?php
$total = 0;

if(!empty($_SESSION['cart'])){

    echo "<table class='table table-bordered'>";
    echo "<tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
          </tr>";

    foreach($_SESSION['cart'] as $id => $qty){

        $id = intval($id);
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");

        if($result && mysqli_num_rows($result) > 0){

            $row = mysqli_fetch_assoc($result);
            $subTotal = $row['price'] * $qty;
            $total += $subTotal;

            echo "<tr>
                    <td>".$row['name']."</td>
                    <td>₹ ".$row['price']."</td>
                    <td>
                        <a href='cart.php?decrease=".$id."' class='btn btn-secondary btn-sm'>-</a>
                        ".$qty."
                        <a href='cart.php?id=".$id."' class='btn btn-success btn-sm'>+</a>
                    </td>
                    <td>₹ ".$subTotal."</td>
                    <td>
                        <a href='cart.php?remove=".$id."' class='btn btn-danger btn-sm'>Remove</a>
                    </td>
                  </tr>";
        }
    }

    echo "<tr>
            <td colspan='3'><strong>Grand Total</strong></td>
            <td colspan='2'><strong>₹ ".$total."</strong></td>
          </tr>";

    echo "</table>";

    echo "
        <a href='cart.php?clear=1' class='btn btn-warning'>Clear Cart</a>
        <a href='checkout.php' 
           onclick=\"return confirm('Are you sure you want to checkout?')\" 
           class='btn btn-success'>
           Proceed to Checkout
        </a>
    ";

}else{
    echo "<div class='alert alert-warning'>Your cart is empty!</div>";
}
?>

<br><br>
<a href="products.php" class="btn btn-secondary">Back to Products</a>

</body>
</html>