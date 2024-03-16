<!-- reject_application.php -->

<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    if (empty($username)) {
        echo "Invalid username.";
        exit;
    }

    // Connect to the database
    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update status to 'Rejected' in the 'application_table'
    $updateQuery = "UPDATE application_table SET Project_status = 'Rejected' WHERE username = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        echo "Application rejected successfully.";
    } else {
        echo "Error updating status in the 'application_table': " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
