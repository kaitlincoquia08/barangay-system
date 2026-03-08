<?php
session_start();
include 'db.php';

if($_SESSION['role']!="user"){
header("Location: login.php");
}
?>

<link rel="stylesheet" href="style.css">

<div class="navbar">

<h2>Barangay Concepcion Dos</h2>

<div class="menu">
<a href="user_dashboard.php">Home</a>
<a href="logout.php">Logout</a>
</div>

</div>

<div class="hero">

<h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1> 




</div>

<div class="container">

<h2>Upcoming Events</h2>

<div class="event-card-table">

<div class="event-row header">

<div class="col name">Event</div>
<div class="col date">Date</div>
<div class="col status">Status</div>
<div class="col action">Action</div>

</div>

<?php

$result=$conn->query("SELECT * FROM events ORDER BY date ASC");

while($row=$result->fetch_assoc()){

?>

<div class="event-row">

<div class="col name">
<?php echo $row['title']; ?>
</div>

<div class="col date">
<?php echo date("F j, Y",strtotime($row['date'])); ?>
</div>

<div class="col status">
<?php echo $row['status']; ?>
</div>

<div class="col action">

<a href="view_event.php?id=<?php echo $row['id']; ?>" class="view-btn">
View
</a>

</div>

</div>

<?php } ?>

</div>
</div>