<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Payment Page</h1>

    <?php
    session_start();
    include 'config.php';
    // include 'store_payment.php';
    
    $mail = $_SESSION['user_email'];
    $query = "SELECT * from company_profile_table WHERE email= '$mail' ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //assign value to separate variable
            $Username = $row['username'];
            $name = $row['Company_name'];
            $email = $row['email'];
            $phone = $row['phone'];
        }
    }

    // Include your Razorpay API keys here
    $razorpay_key_id = 'rzp_test_YJvQQ0a9oDMBqb';
    $razorpay_secret = 'mLuNQBQB2XG8t3nbs6ayry0W';
    if (isset($_GET['plan']) && isset($_GET['price'])) {
        $plan = $_GET['plan'];
        $price = $_GET['price'];
    } else {
        echo 'Invalid plan information.';
        exit;
    }
    ?>

    <div>
        <p>Plan: <?php echo $plan; ?></p>
        <p>Price: ₹<?php echo $price; ?></p>
        <p>Billing Name: <?php echo $name; ?></p>
        <p>Billing Email: <?php echo $email; ?></p>
      
    </div>
    <button id="pay-button">Pay Now</button>

    <script>
        $(document).ready(function () {
            var options = {
                key: "<?php echo $razorpay_key_id; ?>",
                amount: <?php echo $price * 100; ?>, // Amount in paise (1 USD = 100 paise)
                name: "FreeLancia",
                description: "Payment for <?php echo $plan; ?>",
                image: "logo.png", // Add your logo URL
                handler: function (response) {
                    // Redirect to success page or handle payment success here
                    console.log(response);

                    // Send payment details to a PHP script for database insertion
                    $.ajax({
                        type: 'POST',
                        url: 'store_payment.php', // Modify the URL to the PHP script
                        data: {
                            plan: "<?php echo $plan; ?>",
                            price: <?php echo $price; ?>,
                            razorpay_transaction_id: response.razorpay_payment_id,
                            username: "<?php echo $Username; ?>",
                            Company_name: "<?php echo $name; ?>",
                            email: "<?php echo $email; ?>",
                            phone: "<?php echo $phone; ?>",
                        },
                        success: function (data) {
                            // Handle the response from the server (e.g., a success message)
                            console.log(data);
                            alert("Payment successful!");
                            document.location.replace = '../../dash.php';
                        },
                        error: function (error) {
                            // Handle the error, if any
                            console.error(error);
                            alert("Payment successful, but there was an error storing the details.");
                        },
                    });
                },
                prefill: {
                    name: "<?php echo $Username; ?>",
                    email: "<?php echo $email; ?>",
                    contact: "<?php echo $phone; ?>",
                },
                theme: {
                    color: "#F37254",
                },
            };

            var rzp = new Razorpay(options);
            document.getElementById("pay-button").onclick = function () {
                rzp.open();
            };
        });
    </script>
</body>
</html>
