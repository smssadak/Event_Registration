<?php
session_start();
include 'db.php'; // Make sure to include the database connection

// Assuming $_SESSION['user_id'] is set when the user logs in
$userid = $_SESSION['admin_id']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #000000; /* Black background */
            color: #ffffff; /* White text */
        }
        .container {
            margin-top: 50px;
        }
        .btn-custom {
            margin: 10px;
        }
        .event-card {
            background-color: #1c1c1e;
            border: 1px solid #444;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
        }
        .event-card h5 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-center">Event Management</h1>
        <!-- Add Event Button -->
        <div class="text-center mb-4">
            <button class="btn btn-outline-light btn-lg btn-custom" onclick="showAddEvent()">Add Event</button>
        </div>

        <!-- Event List -->
        <div id="eventList">
            <?php include 'load_events.php'; ?>
        </div>
    </div>

    <!-- Add Event Form Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Event Form -->
                    <form id="addEventForm" method="POST" action="add_event.php">
                        <div class="form-group">
                            <label for="eventName">Event Name</label>
                            <input type="text" class="form-control" id="eventName" name="eventName" required>
                        </div>
                        <div class="form-group">
                            <label for="eventVenue">Venue</label>
                            <input type="text" class="form-control" id="eventVenue" name="eventVenue" required>
                        </div>
                        <div class="form-group">
                            <label for="eventDate">Date</label>
                            <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                        </div>
                        <div class="form-group">
                            <label for="eventDetails">Event Details</label>
                            <textarea class="form-control" id="eventDetails" name="eventDetails" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-light">Add Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showAddEvent() {
            $('#addEventModal').modal('show');
        }

        <?php if(isset($_SESSION['event_message'])): ?>
            alert('<?php echo $_SESSION['event_message']; ?>');
            <?php unset($_SESSION['event_message']); // Clear the message ?>
        <?php endif; ?>
    </script>
</body>
</html>
