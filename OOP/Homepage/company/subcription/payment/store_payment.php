<?php
session_start();
@include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plan = $_POST["plan"];
    $price = $_POST["price"];
    $razorpayTransactionID = $_POST["razorpay_transaction_id"];
    $Username = $_POST["username"];
    $name = $_POST["Company_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $paymentStatus = "success";

    // Create a connection
    $conn = mysqli_connect($server, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    // Prepare the SQL statement to insert payment details
    $sql = "INSERT INTO `subscription_table` (`username`, `Company_name`, `email`, `phone`, `plan`, `price`, `razorpay_transaction_id`, `status`) 
        VALUES ('$Username', '$name', '$email', '$phone', '$plan', '$price', '$razorpayTransactionID', '$paymentStatus')";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        // Send a success response to the client
        
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
        // $mail = $this->initializeMailer();
        $mail->setFrom('freelanciateam@gmail.com', 'FreeLancia');
        $mail->addAddress($_SESSION['user_email']);
        $mail->isHTML(true);
        $mail->Subject = 'Subscription Confirmation';
        $mail->Body = "Hello $name, you buy your Subscription Successfully.Your plan name $plan and price of your subscription $price. Billing name of this Subscription $name.Now enjoy your subscription.";

        if (!$mail->send()) {
        echo "Mail send Failed";
        } else {
         echo "Subscription buy Successfully";
            }
    } else {
        // Handle the error
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
