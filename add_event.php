<?php
session_start();
include 'db.php';
$user_id = $_SESSION['admin_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['eventName'];
    $venue= $_POST['eventVenue'];
    $date = $_POST['eventDate'];
    $details = $_POST['eventDetails'];
     
    $add_sql = "INSERT INTO events (name, venue, date, userId, details) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($add_sql);
    $stmt->bind_param("sssss", $name, $venue, $date, $user_id,  $details);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
