<?php include("includes/header.php"); ?>
<?php ("../config/db.php");

<h2 class="mb-4">All Products</h1>

<div class="row">

<?php
$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
?>

    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="assets/image/<?php echo $row['image']; ?>" class="card-img-top" height="250">

            <div class="card-body">
                <h5><?php echo $row['name']; ?></h5>
                <p>₹<?php echo $row['price']; ?></p>
                <a href="add_to_cart.php?id=<?php
                echo$row['id']; ?>"
                class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
    </div>

<?php } ?>

</div>

<?php include("includes/footer.php"); 