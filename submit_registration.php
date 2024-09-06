<?php
include 'db.php';

// Retrieve form data
$user_id = $_POST['userId'] ?? null;
$event_id = $_POST['eventId'] ?? null;
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$phoneNo = $_POST['phoneNo'] ?? null;

if ($user_id && $name && $email && $phoneNo) {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO participants (NameOfParticipant, email, phoneNo, userId, eventId) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi",  $name, $email, $phoneNo, $user_id, $event_id);

    if ($stmt->execute()) { 
        echo  "<script>alert('Registration successful!'); window.location.href='event_details.php';</script>";

    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>All fields are required.</p>";
}

$conn->close();
?>
