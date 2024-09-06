<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id']) || !isset($_POST['eventId'])) {
    echo "Invalid access.";
    exit;
}

$userid = $_SESSION['admin_id'];
$eventId = $_POST['eventId'];
$name = $_POST['name'];
$venue = $_POST['venue'];
$date = $_POST['date'];
$details = $_POST['details'];

// Update the event details in the database
$sql = "UPDATE events SET name = ?, venue = ?, date = ?, details = ? WHERE Id = ? AND userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssii", $name, $venue, $date, $details, $eventId, $userid);

if ($stmt->execute()) {
    echo "Event updated successfully.";
    header('Location: admin_dashboard.php');
} else {
    echo "Error updating event: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
