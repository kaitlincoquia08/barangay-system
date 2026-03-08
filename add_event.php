<?php
session_start();
include 'db.php';

// Redirect non-admins
if($_SESSION['role'] != "admin"){
    header("Location: login.php");
    exit();
}

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$image);

    $sql = "INSERT INTO events(title, date, time, location, status, description, image)
            VALUES('$title', '$date', '$time', '$location', '$status', '$description', '$image')";

    $conn->query($sql);

    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event - Barangay Concepcion Dos</title>
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

<!-- FORM -->
<div class="form-container">
    <div class="form-box">
        <h2>Add New Event</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" placeholder="Enter event title" required>

            <label for="date">Date</label>
            <input type="date" name="date" id="date" required>

            <label for="time">Time</label>
            <input type="time" name="time" id="time" required>

            <label for="location">Location</label>
            <input type="text" name="location" id="location" placeholder="Enter location" required>

            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="Open">Open</option>
                <option value="Full">Full</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Enter event description"></textarea>

            <label for="image">Event Image</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <!-- Styled Add Event Button -->
            <button type="submit" class="add-event-btn">Add Event</button>
        </form>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    &copy; <?php echo date("Y"); ?> Barangay Concepcion Dos. All Rights Reserved.
</div>

</body>
</html>