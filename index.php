<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styling for background and text color */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        /* Container styling to center content */
        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>

<div class="container main-container">
    <h1 class="text-center mb-4">Welcome to the Event Management System</h1>
    <div class="d-flex justify-content-center">
        <form action="admin.php" method="get" class="mr-2">
            <button type="submit" class="btn btn-dark btn-lg">Admin</button>
        </form>
        <form action="event_details.php" method="get" class="ml-2">
            <button type="submit" class="btn btn-dark btn-lg">Events</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
