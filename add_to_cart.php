 <?php
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

header("Location: cart.php");
exit;
?>