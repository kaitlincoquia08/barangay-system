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


<!-- HERO SECTION -->
<div class="hero hero-slideshow">
  <div class="hero-slideshow-wrapper">
    <div class="slide" style="background-image: url('slide1.jpg');"></div>
    <div class="slide" style="background-image: url('slide2.jpg');"></div>
    <div class="slide" style="background-image: url('slide3.jpg');"></div>
  </div>
  
  <div class="hero-overlay"></div>

  <div class="hero-content">
    <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
    <p>Stay updated with the latest barangay programs and community events.</p>
  </div>
</div>


<div class="container">

<h2 class="section-title">Upcoming Events</h2>


<div class="event-grid">

<?php

$result=$conn->query("SELECT * FROM events ORDER BY date ASC");

while($row=$result->fetch_assoc()){

?>

<div class="event-card">

<img src="uploads/<?php echo $row['image']; ?>" class="event-img">

<div class="event-card-content">

<h3><?php echo $row['title']; ?></h3>

<p class="event-date">
<?php echo date("F j, Y",strtotime($row['date'])); ?>
</p>

<span class="status <?php echo strtolower($row['status']); ?>">
<?php echo $row['status']; ?>
</span>

<a href="view_event.php?id=<?php echo $row['id']; ?>" class="details-btn">
View Details <span class="arrow">→</span>
</a>

</div>

</div>

<?php } ?>

</div>

</div>