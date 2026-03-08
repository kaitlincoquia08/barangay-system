<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) == 1){

$row = mysqli_fetch_assoc($result);

if($password == $row['password']){

$_SESSION['id'] = $row['id'];
$_SESSION['name'] = $row['name'];
$_SESSION['role'] = $row['role'];

if($row['role'] == "admin"){

header("Location: admin_dashboard.php");

}else{

header("Location: user_dashboard.php");

}

exit();

}else{

$message = "Incorrect password.";

}

}else{

$message = "User does not exist.";

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

<h2>Login</h2>

<?php
if($message != ""){
echo "<p style='color:red;text-align:center;'>$message</p>";
}
?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<p style="text-align:center;margin-top:10px;">
Don't have an account?
<a href="register.php">Register</a>
</p>

</div>

</div>