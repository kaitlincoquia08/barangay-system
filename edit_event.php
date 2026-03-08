<?php
session_start();
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM events WHERE id=$id");
$row = $result->fetch_assoc();

if($_SERVER["REQUEST_METHOD"]=="POST"){

$title=$_POST['title'];
$date=$_POST['date'];
$time=$_POST['time'];
$status=$_POST['status'];
$location=$_POST['location'];
$description=$_POST['description'];

$image=$_FILES['image']['name'];
$tmp=$_FILES['image']['tmp_name'];

if($image!=""){
    move_uploaded_file($tmp,"uploads/".$image);

    $sql="UPDATE events
    SET title='$title',
    date='$date',
    time='$time',
    status='$status',
    location='$location',
    description='$description',
    image='$image'
    WHERE id=$id";
}
else{
    $sql="UPDATE events
    SET title='$title',
    date='$date',
    time='$time',
    status='$status',
    location='$location',
    description='$description'
    WHERE id=$id";
}

$conn->query($sql);

header("Location: admin_dashboard.php");
exit();
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


<div class="form-container">

<div class="form-box">

<h2>Edit Event</h2>

<form method="POST" enctype="multipart/form-data">

<label>Event Title</label>
<input type="text" name="title" value="<?php echo $row['title']; ?>" required>

<label>Date</label>
<input type="date" name="date" value="<?php echo $row['date']; ?>" required>

<label>Time</label>
<input type="time" name="time" value="<?php echo $row['time']; ?>" required>

<label>Location</label>
<input type="text" name="location" value="<?php echo $row['location']; ?>" required>

<label>Status</label>
<select name="status">

<option value="Open" <?php if($row['status']=="Open") echo "selected"; ?>>Open</option>
<option value="Full" <?php if($row['status']=="Full") echo "selected"; ?>>Full</option>
<option value="Cancelled" <?php if($row['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>

</select>

<label>Description</label>
<textarea name="description"><?php echo $row['description']; ?></textarea>


<label>Upload New Image</label>
<input type="file" name="image">

<button type="submit" class="add-event-btn">Update Event</button>

</form>

</div>

</div>

</body>
</html>