<?php
session_start();

// Include the database connection file
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the action (approve or reject)
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    // Get the username
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    if (empty($username) || empty($action)) {
        echo "Invalid input.";
        exit;
    }

    // Connect to the database
    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update status in the 'application_table'
    $updateQuery = "UPDATE application_table SET Project_status = ? WHERE username = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $action, $username);

    if ($stmt->execute()) {
        // If approved, insert data into the 'approved' table (replace 'approved_table' with your actual table name)
        if ($action == 'Approved') {
            $insertQuery = "INSERT INTO approved_table (username, Applicant_name, Project_Name) 
                            SELECT username, Applicant_name, Project_Name 
                            FROM application_table 
                            WHERE username = ?";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                echo "Approved";
            } else {
                echo "Error inserting data into the 'approved_table': " . $stmt->error;
            }
        } else {
            // If rejected, no need to insert into 'approved' table
            echo "Rejected";
        }
    } else {
        echo "Error updating status in the 'application_table': " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
