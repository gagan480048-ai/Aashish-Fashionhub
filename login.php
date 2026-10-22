<?php
session_start();
include("config/db.php");
include("includes/header.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        echo "<div class='alert alert-success'>Login Successful</div>";
        header("refresh:1;url=index.php");

    } else {
        echo "<div class='alert alert-danger'>Invalid Email or Password</div>";
    }
}
?>

<div class="container mt-5">
<h2>Login</h2>
<form method="post">
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button name="login" class="btn btn-success">Login</button>
</form>
</div>

<?php include("includes/footer.php"); ?>