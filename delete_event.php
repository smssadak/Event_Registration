<?php
session_start();
include 'db.php';

// Check if the user is logged in and the event ID is provided
if (!isset($_SESSION['admin_id']) || !isset($_POST['eventId'])) {
    echo "Invalid access.";
    exit;
}

$userid = $_SESSION['admin_id'];
$eventId = $_POST['eventId'];

// Prepare the SQL statement to delete the event
$sql = "DELETE FROM events WHERE Id = ? AND userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $eventId, $userid);

// Execute the deletion
if ($stmt->execute()) {
    // Redirect to a success page or show a success message
    echo "Event deleted successfully.";
    // Uncomment the following line to redirect the user
    header('Location: admin_dashboard.php');
} else {
    // Show an error message if the deletion fails
    echo "Error deleting event: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
