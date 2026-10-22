<?php
session_start();

if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "1234"){
        $_SESSION['admin'] = true;
        header("Location: products.php");
    } else {
        echo "<div style='color:red'>Invalid Admin Login</div>";
    }
}
?>

<h2>Admin Login</h2>
<form method="post">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>