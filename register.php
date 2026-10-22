<?php
include("config/db.php");
include("includes/header.php");

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Registration Successful! <a href='login.php'>Login Now</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Email already exists!</div>";
    }
}
?>

<div class="container mt-5">
<h2>Register</h2>
<form method="post">
<input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button name="register" class="btn btn-primary">Register</button>
</form>
</div>

<?php include("includes/footer.php"); ?>