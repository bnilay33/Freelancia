<?php
session_start();
@include 'config.php';

// // $email =   $_SESSION['user_email'];
// $query = "SELECT * from company_profile_table";
// $result = mysqli_query($connection,$query);

// if($result && mysqli_num_rows($result)>0){
//   while($row = mysqli_fetch_assoc($result)){
//     //assign value to separate variable
//     $name = $row['Company_name'];
//     $email = $row['email'];
//     $phone = $row['phone'];
//   }
// }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="subcription.css">
</head>
<body>
    <div class="container">
        <B>
            <h1>
                Explore Our Plans
            </h1>
        </B>
        <!-- <div class="price-toggler">
            <span class="month active">Monthly</span>
            <span class="year">Quarterly</span>
        </div> -->

        <div class="box-container">
            <div class="box">
                <div class="pricing-card basic">
                    <div class="pricing-header">
                        <span class="plan-title">BASIC PLAN</span>
                        <div class="price-circle">
                            <span class="price-title">
                                <div class="price month"><small>₹</small><span>99</span></div>
                                <div class="price year"><small>₹</small><span>279</span></div>
                            </span>
                            <!-- <span class="info">
                                <div class="price month"><span>/ Monthly</span></div>
                                <div class="price year"><span>/ Quarterly</span></div>
                            </span> -->
                        </div>
                    </div>
                    <div class="badge-box">
                        <span>Save 5%</span>
                    </div>
                    <ul>
                        <li>
                            <strong>Job Post</strong> <b> : 2</b>
                        </li>
                        <li>
                            <strong>Dedicated</strong><b> : Dashboard</b>
                        </li>
                        <li>
                            <strong>Support</strong> <b> : 24/4</b>
                        </li>
                    </ul>
                    <div class="buy-button-box">
                        <div class="price month">
                            <a href="javascript:void(0);" class="buy-now" onclick="redirectToPayment('BASIC PLAN', 99)">BUY NOW</a>
                        </div>
                        <div class="price year">
                            <a href="javascript:void(0);" class="buy-now" onclick="redirectToPayment('BASIC PLAN',279)">BUY NOW</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add similar code for other plans -->
            <div class="box">
                <div class="pricing-card echo">
                  <div class="popular"><b>POPULAR</b></div>
                  <div class="pricing-header">
                    <span class="plan-title">STANDARD PLAN</span>
                    <div class="price-circle">
                      <span class="price-title">
                        <div class="price month"> <small>₹</small><span>159</span></div>
                        <div class="price year"><small>₹</small><span>459</span></div> 
                      </span>
                      <!-- <span class="info">
                        <div class="price month"><span>/ Monthly</span></div>
                        <div class="price year"><span>/ Quarterly</span></div>  
                      </span> -->
                    </div>
                  </div>
                  <div class="badge-box">
                    <span>Save 10%</span>
                  </div>
                  <ul>
                    <li>
                      <strong>Job Post  </strong> <b> : 3</b>
                    </li>
                    <li>
                      <strong>Dedicated</strong> <b> : Dashboard</b>
                    </li>
                    <li>
                      <strong>Support  </strong> <b> : 24/5 </b>
                    </li>
                    
                  </ul>
                  <div class="buy-button-box">
                    <div class="price month">  
                        <a href="javascript:void(0);" class="buy-now" onclick="redirectToPayment('STANDARD PLAN', 159)">BUY NOW</a>
                    </div>
                        <div class="price year">  
                            <a href="javascript:void(0);" class="buy-now" onclick="redirectToPayment('STANDARD PLAN', 459)">BUY NOW</a>
                        </div>
                  </div>
                </div>
              </div>


              <div class="box">
                <div class="pricing-card pro">
                  <div class="pricing-header">
                    <span class="plan-title">PREMIUM PLAN</span>
                    <div class="price-circle">
                      <span class="price-title">
                        <div class="price month"><small>₹</small><span>399</span></div>
                        <div class="price year"><small>₹</small><span>1199</span></div> 
                      </span>
                      <!-- <span class="info">
                        <div class="price month"><span>/ Monthly</span></div>
                        <div class="price year"><span>/ Quarterly</span></div>  
                      </span> -->
                    </div>
                  </div>
                  <div class="badge-box">
                    <span>Save 15%</span>
                  </div>
                  <ul>
                    <li>
                      <strong>Job Post </strong> <b> : 5</b>
                    </li>
                    <li>
                      <strong>Dedicated</strong> <b> : Dashboard</b>
                    </li>
                    <li>
                      <strong>Support  </strong> <b> : 24/7 </b>
                    </li>
            
                  </ul>
                  <div class="buy-button-box">
                    <div class="price month">  
                        <a href="javascript:void(0);" class="buy-now" onclick="redirectToPayment('PREMIUM PLAN', 399)">BUY NOW</a>
                    </div>
                        <div class="price year">  
                            <a href="javascript:void(0);" class="buy-now" onclick="redirectToPayment('PREMIUM PLAN', 1199)">BUY NOW</a>
                        </div>  
                  </div>
                </div>
              </div>


        </div>
    </div>

    <script>
        function redirectToPayment(plan, price) {
            // Encode plan and billing for URL
            plan = encodeURIComponent(plan);
            

            // Redirect to the payment page (pay.php) with plan data as URL parameters
            window.location.href = `payment/pay.php?plan=${plan}&price=${price}`;
        }
    </script>

    <script src="subcription.js"></script>
</body>
</html>
