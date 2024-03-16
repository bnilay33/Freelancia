<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Approve.css">
</head>
<body>
    <!--Table-->
    <main class="table">
        <section class="table__header">
            <h1>Approved Candidates</h1>
            
            
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        
                        
                        <th> Applicant Name <i class="fa-solid fa-user-tie fa-fade"></i> </th>
                        <th> Project Name <i class="fa-solid fa-briefcase fa-fade"></i></th>
                        <th> Apply Date <i class="fa-regular fa-calendar-days fa-beat"></i></th>
                        <th> Bid Amount <i class="fa-solid fa-dollar-sign fa-flip"></i></th>
                    </tr>
                </thead>

<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freelanciaaa";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mail = $_SESSION['user_email'];
// Fetch approved candidat
$sql = "SELECT Company_name from company_profile_table WHERE email = '$mail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Name = $row['Company_name'];

        // Fetch additional information from application_table
        $sqlApplication = "SELECT a.username , a.Applicant_name, a.Project_Name,DATE_FORMAT(b.dt,'%d/%m/%Y') AS Date , b.Estimated_Charge
        FROM approve_table a
        INNER JOIN application_table b ON a.username = b.username AND a.Applicant_name = b.Applicant_name AND a.Project_Name = b.Project_Name WHERE Company_name = '$Name' AND Project_status = 'approved' ";
        $resultApplication = $conn->query($sqlApplication);

        if ($resultApplication->num_rows > 0) {
            while ($rowApplication = $resultApplication->fetch_assoc()) {
                $Applicant_name = $rowApplication['Applicant_name'];
                $Project_Name = $rowApplication['Project_Name'];
                $applyDate = $rowApplication['Date'];
                $bidAmount = $rowApplication['Estimated_Charge'];

                
                echo'<tbody>';
                echo '<tr>'; 
                echo " <td> <img src='dark-blue-product-background.jpg' alt=''> <a href='' style='text-decoration:none; color:black;'>$Applicant_name </a></td>" ; 
                echo "<td><a href='' style='text-decoration:none; color:black;'> $Project_Name</a> </td>";
                echo "<td> $applyDate </td>";
                echo "<td> <strong> $bidAmount </strong></td>";
                echo '</tr>
                    <tr>
                </tbody>';
                // Now you have all the information, you can use it as needed
                // echo "User Name: $userName<br>";
                // echo "Project Name: $projectName<br>";
                // echo "Apply Date: $applyDate<br>";
                // echo "Bid Amount: $bidAmount<br>";
                // echo "---------------------------<br>";
            }
        }else {
            echo " --No approved candidates found for $Name<br>";
        }
    }
} 

$conn->close();
?>

            </table>
        </section>
    </main>
</body>
</html>