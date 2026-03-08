<?php
session_start();
include 'db.php';


if(!isset($_SESSION['name'])){
   header("Location: login.php");
   exit;
}


if(!isset($_GET['id'])){
   header("Location: user_dashboard.php");
   exit;
}


$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
if(!$event){
   echo "Event not found.";
   exit;
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


<div class="container">


   <h2><?php echo $event['title']; ?></h2>


   <div class="event-detail-card">
       <img src="uploads/<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
       <p><b>Date:</b> <?php echo date("F j, Y", strtotime($event['date'])); ?></p>
       <p><b>Location:</b> <?php echo $event['location']; ?></p>
       <p><b>Status:</b> <?php echo $event['status'] ?? "Open"; ?></p>
       <p><b>Description:</b> <?php echo $event['description']; ?></p>
   </div>


</div>

