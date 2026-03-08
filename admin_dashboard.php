<?php
session_start();
include 'db.php';

if($_SESSION['role']!="admin"){
header("Location: login.php");
}
?>

<link rel="stylesheet" href="style.css">

<div class="navbar">
<h2>Barangay Concepcion Dos</h2>

<div class="menu">
<a href="admin_dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>
</div>

</div>

<div class="container">

    <h2>Manage Events</h2>

    <!-- Add Event Button aligned to the right -->
    <div class="button-container">
        <a href="add_event.php" class="btn add-event-btn-dashboard">Add Event</a>
    </div>

    <div class="event-card-table">

        <div class="event-row header">
            <div class="col name">ID / Event</div>
            <div class="col date">Date</div>
            <div class="col status">Status</div>
            <div class="col action">Actions</div>
        </div>

        <?php
        $result = $conn->query("SELECT * FROM events ORDER BY date ASC");
        while($row = $result->fetch_assoc()) {
            $eid = str_pad($row['id'], 3, "0", STR_PAD_LEFT);
        ?>
<div class="event-row">
    <div class="col name">
        <span class="event-id">ID <?php echo $eid; ?></span><br>
        <span class="event-title"><?php echo $row['title']; ?></span>
    </div>
    <div class="col date">
        <?php echo date("F j, Y", strtotime($row['date'])); ?>
    </div>
    <div class="col status">
        <span class="status <?php echo strtolower($row['status']); ?>">
            <?php echo $row['status']; ?>
        </span>
    </div>
    <div class="col action">
        <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="view-btn">Edit</a>
        <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="view-btn delete-btn">Delete</a>
    </div>
</div>
        <?php } ?>

    </div>
</div>