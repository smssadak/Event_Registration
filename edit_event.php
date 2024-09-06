<?php
// Start the session to access session variables
session_start();

// Include the database connection
include 'db.php';

// Check if the user is logged in and the event ID is provided
if (!isset($_SESSION['admin_id']) || !isset($_POST['eventId'])) {
    echo "Invalid access.";
    exit;
}

$userid = $_SESSION['admin_id'];
$eventId = $_POST['eventId'];

// Fetch the event details for the specified event ID and user
$sql = "SELECT * FROM events WHERE Id = ? AND userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $eventId, $userid);
$stmt->execute();
$result = $stmt->get_result();

// Check if the event exists
if ($result->num_rows === 0) {
    echo "Event not found.";
    exit;
}

$event = $result->fetch_assoc();

// Close the statement
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Event</h2>
    <form method="POST" action="update_event.php">
        <input type="hidden" name="eventId" value="<?php echo htmlspecialchars($event['Id']); ?>">
        <div class="form-group">
            <label for="name">Event Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" class="form-control" id="venue" name="venue" value="<?php echo htmlspecialchars($event['venue']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" rows="4" required><?php echo htmlspecialchars($event['details']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
