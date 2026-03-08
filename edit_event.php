<?php
session_start();
include 'db.php';

$id=$_GET['id'];

$result=$conn->query("SELECT * FROM events WHERE id=$id");
$row=$result->fetch_assoc();

if($_SERVER["REQUEST_METHOD"]=="POST"){

$title=$_POST['title'];
$date=$_POST['date'];
$time=$_POST['time'];
$status=$_POST['status'];
$location=$_POST['location'];
$description=$_POST['description'];

$sql="UPDATE events
SET title='$title',
date='$date',
time='$time',
status='$status',
location='$location',
description='$description'
WHERE id=$id";

$conn->query($sql);

header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event - Barangay Concepcion Dos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>Barangay Concepcion Dos</h2>
    <div class="menu">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<link rel="stylesheet" href="style.css">

<div class="form-container">

<div class="form-box">

<h2>Edit Event</h2>

<form method="POST">

<input type="text" name="title" value="<?php echo $row['title']; ?>">

<input type="date" name="date" value="<?php echo $row['date']; ?>">

<input type="time" name="time" value="<?php echo $row['time']; ?>">

<input type="text" name="location" value="<?php echo $row['location']; ?>">

<select name="status">

<option <?php if($row['status']=="Open") echo "selected"; ?>>Open</option>
<option <?php if($row['status']=="Full") echo "selected"; ?>>Full</option>
<option <?php if($row['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>

</select>

<textarea name="description"><?php echo $row['description']; ?></textarea>

<button type="submit">Update Event</button>

</form>

</div>
</div>