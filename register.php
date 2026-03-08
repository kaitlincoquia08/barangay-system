<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user already exists
    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        $message = "User already exists! Please login.";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (name,email,password,role)
                VALUES ('$name','$email','$password','user')";

        if(mysqli_query($conn,$sql)){
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            $message = "Registration failed. Please try again.";
        }
    }
}
?>

<!-- NAVBAR -->
<div class="navbar">
    <h2>Barangay Concepcion Dos</h2>
    <div class="menu">
        <a href="index.php">Home</a>
    </div>
</div>

<link rel="stylesheet" href="style.css">

<div class="form-container">
    <div class="form-box">
        <h2>Register</h2>

        <?php
        if($message != ""){
            echo "<p style='color:red;text-align:center;'>$message</p>";
        }
        ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>

        <p style="text-align:center;margin-top:10px;">
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </div>
</div>