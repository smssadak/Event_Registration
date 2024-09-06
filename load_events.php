<?php
// session_start();
include 'db.php'; // Ensure the database connection
$userid = $_SESSION['admin_id'];
// Fetch events for the current user
$sql = "SELECT * FROM events WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($event = $result->fetch_assoc()) {
        echo '<div class="event-card">';
        echo '<h5>' . htmlspecialchars($event['name']) . '</h5>';
        echo '<p><strong>Venue:</strong> ' . htmlspecialchars($event['venue']) . '</p>';
        echo '<p><strong>Date:</strong> ' . htmlspecialchars($event['date']) . '</p>';
        echo '<p><strong>Details:</strong> ' . htmlspecialchars($event['details']) . '</p>';

        // Edit form with hidden inputs
        echo '<form method="POST" action="edit_event.php" style="display:inline;">';
        echo '<input type="hidden" name="eventId" value="' . htmlspecialchars($event['Id']) . '">';
        echo '<input type="hidden" name="userId" value="' . htmlspecialchars($userid) . '">';
        echo '<button type="submit" class="btn btn-primary btn-sm">Edit</button>';
        echo '</form> ';

        // Delete form with hidden inputs
        echo '<form method="POST" action="delete_event.php" style="display:inline;">';
        echo '<input type="hidden" name="eventId" value="' . htmlspecialchars($event['Id']) . '">';
        echo '<input type="hidden" name="userId" value="' . htmlspecialchars($userid) . '">';
        echo '<button type="submit" class="btn btn-danger btn-sm">Delete</button>';
        echo '</form> ';

        // Participants link
        // echo '<a href="participants.php?event_id=' . urlencode($event['id']) . '" class="btn btn-info btn-sm">Participants</a>';
        echo '<form method="POST" action="participants.php" style="display:inline;">';
        echo '<input type="hidden" name="eventId" value="' . htmlspecialchars($event['Id']) . '">';
        echo '<input type="hidden" name="userId" value="' . htmlspecialchars($userid) . '">';
        echo '<button type="submit" class="btn btn-info btn-sm">participants</button>';
        echo '</form> ';
        echo '</div>';
    }
} else {
    echo '<p>No events found.</p>';
}

$stmt->close();
$conn->close();
?>
