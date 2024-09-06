<?php
session_start();
include 'db.php';

// Fetch all events from the database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000; /* Set background color to black */
            color: #fff; /* Set text color to white for better visibility */
        }
        .event-card {
            background-color: #333; /* Darker card background for contrast */
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Event Details</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($event = $result->fetch_assoc()): ?>
            <div class="event-card">
                <h4><?php echo htmlspecialchars($event['name']); ?></h4>
                <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
                <p><strong>Details:</strong> <?php echo htmlspecialchars($event['details']); ?></p>
                
                <!-- Register form with hidden input -->
                <form method="POST" action="register.php" style="display:inline;">
                    <input type="hidden" name="eventId" value="<?php echo htmlspecialchars($event['Id']); ?>">
                    <button type="submit" class="btn btn-success btn-sm">Register</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No events available.</p>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
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
