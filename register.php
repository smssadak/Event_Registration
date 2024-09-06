<?php
include 'db.php';

// Get event details
$event_id = $_POST['eventId'] ?? null;
if ($event_id) {
    $stmt = $conn->prepare("SELECT * FROM events WHERE Id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    die("Event not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for <?php echo htmlspecialchars($event['title']); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #444;
            max-width: 500px;
            margin: 50px auto;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <h2 class="text-center mb-4">Register for <?php echo htmlspecialchars($event['name']); ?></h2>
    <form action="submit_registration.php" method="POST">
        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($event['userId']); ?>">
        <input type="hidden" name="eventId" value="<?php echo htmlspecialchars($event['Id']); ?>">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
        </div>
        <div class="form-group">
            <label for="phone">Your Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phoneNo" placeholder="Your Phone Number" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit Registration</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
