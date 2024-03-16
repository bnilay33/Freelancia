<?php
// Include the database connection file
include 'config.php';

// Get the username from the AJAX request
$username = isset($_POST['username']) ? $_POST['username'] : '';

if (empty($username)) {
    echo "Invalid username.";
    exit;
}

// Connect to the database
$conn = new mysqli($server, $username, $password, $database);


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update status to 'Rejected' in the 'application_table'
$updateQuery = "UPDATE application_table SET status = 'Rejected' WHERE username = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->close();

// Close the database connection
$conn->close();

echo "Application rejected successfully.";
?>
