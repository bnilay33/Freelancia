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

// Update status to 'Approved' in the 'application_table'
$updateQuery = "UPDATE application_table SET status = 'Approved' WHERE username = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->close();

// Insert data into the 'approved' table (replace 'approved_table' with your actual table name)
$insertQuery = "INSERT INTO approved_table (username, applicant_name, project_name) 
                SELECT username, applicant_name, project_name 
                FROM application_table 
                WHERE username = ?";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->close();

// Close the database connection
$conn->close();

echo "Application approved successfully.";
?>
