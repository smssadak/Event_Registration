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

// Fetch the event name using the event ID
$eventName = "";
$eventQuery = "SELECT name FROM events WHERE Id = ?";
$stmtEvent = $conn->prepare($eventQuery);
$stmtEvent->bind_param("i", $eventId);
$stmtEvent->execute();
$eventResult = $stmtEvent->get_result();

if ($eventResult->num_rows > 0) {
    $event = $eventResult->fetch_assoc();
    $eventName = $event['name'];
} else {
    echo "Event not found.";
    exit;
}

// Prepare the SQL statement to fetch participants for the given event
$sql = "SELECT NameOfParticipant, email, phoneNo FROM participants WHERE eventid = ? AND userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $eventId, $userid);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table thead th {
            color: #fff; /* Table header text color */
        }

        .table tbody td {
            color: #ddd; /* Table body text color */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Participants for Event: <?php echo htmlspecialchars($eventName); ?></h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($participant = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($participant['NameOfParticipant']); ?></td>
                        <td><?php echo htmlspecialchars($participant['email']); ?></td>
                        <td><?php echo htmlspecialchars($participant['phoneNo']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No participants found for this event.</p>
    <?php endif; ?>

    <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Events</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the statements and connection
$stmt->close();
$stmtEvent->close();
$conn->close();
?>
