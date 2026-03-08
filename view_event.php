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

$statusClass = strtolower($event['status']);
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $event['title']; ?></title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
<h2>Barangay Concepcion Dos</h2>

<div class="menu">
<a href="user_dashboard.php">Home</a>
<a href="logout.php">Logout</a>
</div>
</div>


<div class="container">

<div class="event-view-wrapper">

<!-- EVENT IMAGE -->
<div class="event-view-image">
<img src="uploads/<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
</div>

<!-- EVENT CONTENT -->
<div class="event-view-content">

<h1 class="event-title-main"><?php echo $event['title']; ?></h1>

<span class="status <?php echo $statusClass; ?>">
<?php echo $event['status']; ?>
</span>

<div class="event-info">

<div class="event-info-row">
<b>Date:</b>
<span><?php echo date("F j, Y", strtotime($event['date'])); ?></span>
</div>

<div class="event-info-row">
<b>Time:</b>
<span><?php echo date("g:i A", strtotime($event['time'])); ?></span>
</div>

<div class="event-info-row">
<b>Location:</b>
<span><?php echo $event['location']; ?></span>
</div>

</div>

<div class="event-description">
<h3>Event Description</h3>
<p><?php echo $event['description']; ?></p>
</div>

<a href="user_dashboard.php" class="back-btn">← Back to Events</a>

</div>

</div>

</div>

</body>
</html>