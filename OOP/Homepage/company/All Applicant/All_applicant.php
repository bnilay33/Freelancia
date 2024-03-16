<?php
session_start();


// Include the database connection file
@include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$C_mail = $_SESSION['user_email'];

// Connect to the database
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the icon click is for approval
    // $query = "SELECT * from user_profile_table";
    // $result = mysqli_query($connection, $query);

    // if ($result && mysqli_num_rows($result) > 0) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         //assign value to separate variable
    //         $Username = $row['username'];
    //         $email = $row['email'];
           
    //     }
    // }
    if (isset($_POST["approve"])) {
        $applicantName = $_POST["Applicant_name"];
        $projectName = $_POST["Project_name"];
        $estimatedCharge = $_POST['Estimated_Charge'];
        $Company_name = $_POST['Company_name'];

        $query1 = "SELECT up.username,up.email from user_profile_table up INNER JOIN application_table ap ON up.username = ap.username 
        WHERE ap.Applicant_name = '$applicantName' AND Project_name = '$projectName' AND Company_name = '$Company_name' AND Estimated_Charge = '$estimatedCharge'";
        $result2 = mysqli_query($conn, $query1);
    
        if ($result2 && mysqli_num_rows($result2) > 0) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                //assign value to separate variable
                $Username = $row1['username'];    
                $email = $row1['email'];
        // Perform the insertion to the approval table
        $insertQuery = "INSERT INTO approve_table (username,Applicant_name, Project_name) 
                        VALUES ('$Username','$applicantName', '$projectName')";
        $conn->query($insertQuery);

        // Update the status in the application table
        $updateQuery = "UPDATE application_table SET Project_status = 'approved'
                        WHERE username = '$Username' AND Applicant_name = '$applicantName' AND Project_Name = '$projectName' AND Company_name = '$Company_name' AND Estimated_Charge = '$estimatedCharge'";
        $conn->query($updateQuery);
        if($updateQuery){
        $_SESSION['freelancer_email'] = $email;
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'freelanciateam@gmail.com';
        $mail->Password = 'rjbbfnguqhjokzsm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('freelanciateam@gmail.com', 'FreeLancia');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Approved Confirmation';
         
        $mail->Body = "Hello $applicantName, You application of $projectName project is approved.You bidded on this project $estimatedCharge. Contact - $C_mail when completed your project.";
        if (!$mail->send()) {
            echo "Successful but email not sent!";
        } else {          
          echo "Send";
        }
            } 
            }
        }
        }
    elseif (isset($_POST["reject"])) { // Check if the icon click is for rejection
        $applicantName = $_POST["Applicant_name"];
        $projectName = $_POST["Project_Name"];
        $estimatedCharge = $_POST['Estimated_Charge'];
        $Company_name = $_POST['Company_name'];

        // Update the status in the application table
        $updateQuery = "UPDATE application_table SET Project_status = 'rejected' 
                        WHERE Applicant_name = '$applicantName' AND Project_Name = '$projectName' AND Company_name = '$Company_name' AND Estimated_Charge = '$estimatedCharge'";
        $conn->query($updateQuery);
    }
}

// Prepare the SQL query to retrieve all data from the application_table
// Prepare the SQL query to retrieve all data from the application_table
$query = "SELECT 
            application_table.Applicant_name, 
            application_table.Project_Name, application_table.Company_name, 
            DATE_FORMAT(application_table.dt, '%d/%m/%Y') AS formatted_date,
            application_table.Estimated_Charge,
            application_table.Project_status
          FROM 
            application_table 
          INNER JOIN 
            company_profile_table 
          ON 
            application_table.Company_name = company_profile_table.Company_name 
          LEFT JOIN 
            approve_table
          ON application_table.Applicant_name = approve_table.Applicant_name 
            AND application_table.Project_Name = approve_table.Project_name
          WHERE 
            company_profile_table.email = '$C_mail'";


// Execute the query
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@200;400;500;700&display=swap"
        rel="stylesheet" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="All_applicant's.css">
    <title>Document</title>
</head>

<body>
    <div class="activity">
        <!-- Add your existing HTML content here -->

        <div class="title">

<span class="text">All Applicant's</span>
</div>
<div class="container">

<ul class="responsive-table">

    <li class="table-header">
        <div class="col col-1">Applicant Name</div>
        <div class="col col-2">Project Name</div>
        <div class="col col-3">Applied Date</div>
        <div class="col col-4">Company name</div>
        <div class="col col-5">Bidded Amount</div>
        <div class="col col-6">Action</div>
    </li>

        <!-- Start the loop for displaying applicants -->
        <?php
        @include 'config.php';         

        while ($row = $result->fetch_assoc()) {
            echo '<li class="table-row">';
            echo "<div class='col col-1' data-label='Candidate Name'><a href='#'>{$row['Applicant_name']}</a></div>";
            echo "<div class='col col-2' data-label='Work'><a href=''>{$row['Project_Name']}</a></div>";
            echo "<div class='col col-3' data-label='Applied Date'>{$row['formatted_date']}</div>";
            echo "<div class='col col-4' data-label='Applied Date'>{$row['Company_name']}</div>";
            echo "<div class='col col-5' data-label='Bidded Amount'>{$row['Estimated_Charge']}</div>";
            echo "<div class='col col-6' data-label='Action'>";

            // Check the status and display accordingly
            if ($row['Project_status'] == 'approved') {
                echo '<span class="text">Approved</span>';
            } elseif ($row['Project_status'] == 'rejected') {
                echo '<span class="text">Rejected</span>';
            } else {
                echo '<div class="hov">';
                echo '<div class="tooltip Approve">';
                echo '<span class="tooltipText approve">Approve</span>';
                echo '<i class="fa-solid fa-check-square approve-icon"
                            style="font-size: 20px; color: #21fd16; cursor: pointer; background-color: transparent;"></i>';
                echo '</div>';
                echo '<div class="tooltip Reject">';
                echo '<span class="tooltipText reject">Reject</span>';
                echo '<i class="fa-solid fa-xmark-square reject-icon"
                            style="font-size: 20px; color: red; cursor: pointer; background-color: transparent;"></i>';
                echo '</div>';
                echo '</div>';
                
                echo '</div>';
                 echo '</li>';
            }

        }
        ?>
        <!-- End the loop -->
        
        </ul>
        </div>
        <!-- Add your existing HTML content here -->
    </div>

    <!-- Add your script for handling icon clicks using AJAX -->
    <script>
    $(document).ready(function () {
    $(".approve-icon").click(function () {
        var applicantName = $(this).closest(".table-row").find(".col-1 a").text();
        var projectName = $(this).closest(".table-row").find(".col-2 a").text();
        var estimatedCharge = $(this).closest(".table-row").find(".col-5").text();
        var companyName = $(this).closest(".table-row").find(".col-4").text();

        var iconClicked = $(this); // Store a reference to $(this)

        $.ajax({
            type: "POST",
            url: "All_applicant.php", // Replace with the actual PHP file name
            data: {
                approve: true,
                Applicant_name: applicantName,
                Project_name: projectName,
                Estimated_Charge : estimatedCharge,
                Company_name : companyName

            },
            success: function (response) {
                var actionColumn = iconClicked.closest(".col-6");
                actionColumn.find(".hov").hide(); // Hide all icons
                actionColumn.append('<span class="text">Approved</span>'); // Show Approved text
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $(".reject-icon").click(function () {
        var applicantName = $(this).closest(".table-row").find(".col-1 a").text();
        var projectName = $(this).closest(".table-row").find(".col-2 a").text();
        var estimatedCharge = $(this).closest(".table-row").find(".col-5").text();
        var companyName = $(this).closest(".table-row").find(".col-4").text();

        var iconClicked = $(this); // Store a reference to $(this)

        $.ajax({
            type: "POST",
            url: "All_applicant.php", // Replace with the actual PHP file name
            data: {
                reject: true,
                Applicant_name: applicantName,
                Project_Name: projectName ,
                Estimated_Charge : estimatedCharge,
                Company_name : companyName
            },
            success: function (response) {
                var actionColumn = iconClicked.closest(".col-6");
                actionColumn.find(".hov").hide(); // Hide all icons
                actionColumn.append('<span class="text">Rejected</span>'); // Show Rejected text
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});

</script>

</body>

</html>
