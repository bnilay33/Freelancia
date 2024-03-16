<?php
// Include the database connection file
@include 'config.php';

// Get the email and username from the AJAX request
$applicantEmail = $_POST['email'];
$applicantUsername = $_POST['username'];

// Query to retrieve details based on the email or username
$query = "SELECT * FROM user_profile_table WHERE email = 'bnilay672@gmail.com' AND username = 'F_parthib'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Build HTML with the details
    $details = "<p><strong>Applicant Name:</strong> {$row['Name']}</p>";
    $details .= "<p><strong>Skill:</strong> {$row['skills']}</p>";
    $details .= "<p><strong>Experience:</strong> {$row['experience']}</p>";
    $details .= "<p><strong>10th Result:</strong> {$row['10th_result']}</p>";
    $details .= "<p><strong>12th Result:</strong> {$row['12th_result']}</p>";
    $details .= "<p><strong>UG:</strong> {$row['ug']}</p>";
    $details .= "<p><strong>PG:</strong> {$row['pg']}</p>";

    echo $details;
} else {
    echo "Details not found";
}
?>
